<?php

namespace App\Modules\Management\EmailConfigures\Actions;

class UpdateData
{
    static $model = \App\Modules\Management\EmailConfigures\Models\Model::class;

    public static function execute($request, $slug)
    {
        try {
            if (!$data = self::$model::query()->where('slug', $slug)->first()) {
                return messageResponse('Data not found...', $data, 404, 'error');
            }
            $requestData = $request->validated();

            if ($request->has('status') && $request->status == 'active') {
                self::$model::query()->where('id', '!=', $data->id)->update(['status' => 'inactive']);
            }
     

            $data->update($requestData);
            return messageResponse('Item updated successfully', $data, 201);
        } catch (\Exception $e) {
            return messageResponse($e->getMessage(), [], 500, 'server_error');
        }
    }
}
