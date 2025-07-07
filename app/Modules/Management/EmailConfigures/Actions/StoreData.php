<?php

namespace App\Modules\Management\EmailConfigures\Actions;

class StoreData
{
    static $model = \App\Modules\Management\EmailConfigures\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($request->status == 'active') {
                // Set all existing records to inactive
                self::$model::query()->update(['status' => 'inactive']);
            }
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
