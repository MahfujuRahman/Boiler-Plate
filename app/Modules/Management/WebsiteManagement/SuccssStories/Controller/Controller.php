<?php

namespace App\Modules\Management\WebsiteManagement\SuccssStories\Controller;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\GetAllData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\DestroyData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\GetSingleData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\StoreData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\UpdateData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\UpdateStatus;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\SoftDelete;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\RestoreData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\ImportData;
use App\Modules\Management\WebsiteManagement\SuccssStories\Validations\BulkActionsValidation;
use App\Modules\Management\WebsiteManagement\SuccssStories\Validations\DataStoreValidation;
use App\Modules\Management\WebsiteManagement\SuccssStories\Actions\BulkActions;
use App\Http\Controllers\Controller as ControllersController;


class Controller extends ControllersController
{

    public function index( ){

        $data = GetAllData::execute();
        return $data;
    }

    public function store(DataStoreValidation $request)
    {
        $data = StoreData::execute($request);
        return $data;
    }

    public function show($slug)
    {
        $data = GetSingleData::execute($slug);
        return $data;
    }

    public function update(DataStoreValidation $request, $slug)
    {
        $data = UpdateData::execute($request, $slug);
        return $data;
    }
         public function updateStatus()
    {
        $data = UpdateStatus::execute();
        return $data;
    }

    public function softDelete()
    {
        $data = SoftDelete::execute();
        return $data;
    }
    public function destroy($slug)
    {
        $data = DestroyData::execute($slug);
        return $data;
    }
    public function restore()
    {
        $data = RestoreData::execute();
        return $data;
    }
    public function import()
    {
        $data = ImportData::execute();
        return $data;
    }
    public function bulkAction(BulkActionsValidation $request)
    {
        $data = BulkActions::execute($request);
        return $data;
    }

}