<?php

namespace App\Modules\Management\UserManagement\User\Actions;

use Illuminate\Support\Facades\DB;

class StoreData
{
    static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;
    static $UserAddressModel = \App\Modules\Management\UserManagement\User\Models\UserAddressModel::class;
    static $UserLogModel = \App\Modules\Management\UserManagement\User\Models\UserLogModel::class;
    static $UserSocialLinkModel = \App\Modules\Management\UserManagement\User\Models\UserSocialLinkModel::class;

    public static function execute($request)
    {

        try {
            $requestData = $request->validated();

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $requestData['image'] = uploader($image, 'uploads/users');
            }

            // Convert phone_number to JSON if present
            if (isset($requestData['phone_number'])) {
                if (is_array($requestData['phone_number'])) {
                    $requestData['phone_number'] = json_encode($requestData['phone_number']);
                } elseif (is_string($requestData['phone_number'])) {
                    // Split by comma, trim spaces, and encode as JSON
                    $phones = array_map('trim', explode(',', $requestData['phone_number']));
                    $requestData['phone_number'] = json_encode($phones);
                }
            }

            // Handle social_media: save to another model/table if present
            $socialMediaData = [];
            if (isset($requestData['social_media']) && is_array($requestData['social_media'])) {
                $socialMediaData = $requestData['social_media'];
                unset($requestData['social_media']);
            }

            $requestData['password'] = bcrypt($requestData['password']);
            $address = "{$requestData['state']} , {$requestData['city']} , {$requestData['post']} , {$requestData['country']}";

            DB::beginTransaction();

            // Create user
            $data = self::$model::query()->create([
                'role_id' => $requestData['role_id'],
                'user_name'    => $requestData['user_name'],
                'first_name'   => $requestData['first_name'],
                'last_name'    => $requestData['last_name'],
                'image'        => $requestData['image'] ?? null,
                'email'        => $requestData['email'],
                'password'     => $requestData['password']
            ]);

            //create address
            self::$UserAddressModel::query()->create([
                'user_id' => $data->id,
                'phone_number' => $requestData['phone_number'],
                'state'        => $requestData['state'],
                'city'         => $requestData['city'],
                'post'         => $requestData['post'],
                'country'      => $requestData['country'],
                'address'      => $address,
            ]);

            //create social media links
            if (!empty($socialMediaData)) {
                foreach ($socialMediaData as $item) {
                    // Expecting each $item to be an array with 'media_name' and 'media_link'
                    self::$UserSocialLinkModel::query()->create([
                        'user_id'    => $data->id,
                        'media_name' => $item['media_name'] ?? null,
                        'link'       => $item['media_link'] ?? null,
                    ]);
                }
            }

            //create user log
            self::$UserLogModel::query()->create([
                'user_id' => $data->id,
                'last_seen' => now(),
                'log_details' => json_encode([
                    'ip' => $request->ip(),
                    'time' => now()->toDateTimeString(),
                    'referer' => $request->header('referer'),
                    'request_url' => $request->fullUrl(),
                    'method' => $request->method(),
                    'user_agent' => $request->userAgent(),
                ]),
            ]);
            DB::commit();
            // Return success response
            return messageResponse('Item added successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
