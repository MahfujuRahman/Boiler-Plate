<?php

namespace App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Actions;

class StoreData
{
    static $model = \App\Modules\Management\TestModule\ComprehensiveDataTypeTest\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            // Process file uploads for specific fields
                            if ($request->hasFile('document')) {
                    $file = $request->file('document');
                    $requestData['document'] = uploader($file, 'uploads/TestModule/ComprehensiveDataTypeTest');
                }
          
            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}