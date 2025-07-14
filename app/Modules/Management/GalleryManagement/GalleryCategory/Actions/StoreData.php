<?php

namespace App\Modules\Management\GalleryManagement\GalleryCategory\Actions;

class StoreData
{
    static $model = \App\Modules\Management\GalleryManagement\GalleryCategory\Models\Model::class;

    public static function execute($request)
    {
        try {
            $requestData = $request->validated();

            // Process file uploads for specific fields
            if ($request->hasFile('title')) {
                $file = $request->file('title');
                $requestData['title'] = uploader($file, 'uploads/GalleryManagement/GalleryCategory');
            }
            if ($request->hasFile('description')) {
                $file = $request->file('description');
                $requestData['description'] = uploader($file, 'uploads/GalleryManagement/GalleryCategory');
            }

            if ($data = self::$model::query()->create($requestData)) {
                return messageResponse('Item added successfully', $data, 201);
            }
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
