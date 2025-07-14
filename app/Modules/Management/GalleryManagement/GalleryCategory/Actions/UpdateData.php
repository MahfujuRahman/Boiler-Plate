<?php

namespace App\Modules\Management\GalleryManagement\GalleryCategory\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\GalleryManagement\GalleryCategory\Models\Model::class;

    public static function execute($request,$slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...',$data, 404, 'error');
            }
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
  
            $data->update($requestData);
            return messageResponse('Item updated successfully',$data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(),[], 500, 'server_error');
        }
    }
}