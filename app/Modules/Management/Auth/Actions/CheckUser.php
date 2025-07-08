<?php

namespace App\Modules\Management\Auth\Actions;



class CheckUser
{
    static $model = \App\Modules\Management\UserManagement\User\Models\Model::class;
    public static function execute()
    {
        try {
            if (auth()->check()) {
                $user = self::$model::where('id', auth()->user()->id)
                    ->select([
                        'id',
                        'slug',
                        'user_name',
                        'first_name',
                        'last_name',
                        'email',
                        'image',
                        'role_id',
                    ])->with([
                        'role' => function ($query) {
                            $query->select('id', 'name', 'serial_no');
                        },
                        'address' => function ($query) {
                            $query->selectRaw("id, user_id, state, city, post, country, address, slug, JSON_UNQUOTE(JSON_EXTRACT(phone_number, '$[0]')) as phone_number");
                        },
                        'socialLinks' => function ($query) {
                            $query->select('id','user_id' ,'media_name', 'link','slug');
                        }
                    ])
                    ->first();
                auth()->guard('web')->login($user, 1);
                // $user->role = $user->role()->select('id', 'name', 'serial_no')->first();
                // $user->address = $user->address()->select('id', 'state', 'city', 'post', 'country')->first();
                // $user->socialLinks = $user->socialLinks()->select('id', 'social_name', 'link')->get();
       
                
                return entityResponse($user);
            }
            return response()->json(["User not found"], 404);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
