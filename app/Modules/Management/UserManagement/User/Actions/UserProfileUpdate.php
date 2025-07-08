<?php

namespace App\Modules\Management\UserManagement\User\Actions;

class UserProfileUpdate
{
    static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;

    static $UserAddressModel = \App\Modules\Management\UserManagement\User\Models\UserAddressModel::class;
    static $UserSocialLinkModel = \App\Modules\Management\UserManagement\User\Models\UserSocialLinkModel::class;

    public static function execute($request)
    {
        try {

            if (!$data = self::$model::query()->where('id', auth()->id())->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }

            $requestData = $request->validated();
          
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $requestData['image'] = uploader($image, 'uploads/users');
            }

            self::$model::query()->where('id', auth()->id())->update([
                'user_name'    => $requestData['user_name'],
                'first_name'   => $requestData['first_name'],
                'last_name'    => $requestData['last_name'],
                'image'        => $requestData['image'] ?? 'avatar.png',
                'email'        => $requestData['email'],
            ]);

            $address = "{$requestData['state']} , {$requestData['city']} , {$requestData['post']} , {$requestData['country']}";

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

            // Update or create address
            self::$UserAddressModel::query()->updateOrCreate(
                [
                    'user_id' => auth()->id(),
                ],
                [
                    'phone_number' => $requestData['phone_number'],
                    'state'        => $requestData['state'],
                    'city'         => $requestData['city'],
                    'post'         => $requestData['post'],
                    'country'      => $requestData['country'],
                    'address'      => $address,
                ]
            );

            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
