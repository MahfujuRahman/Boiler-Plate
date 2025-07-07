<?php

namespace App\Modules\Management\CourseManagement\Course\Actions;

class StoreData
{
    static $model = \App\Modules\Management\CourseManagement\Course\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}