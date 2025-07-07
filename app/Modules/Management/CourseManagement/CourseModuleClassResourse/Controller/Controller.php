<?php

namespace App\Modules\Management\CourseManagement\CourseModuleClassResourse\Controller;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\GetAllData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\DestroyData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\GetSingleData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\StoreData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\UpdateData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\UpdateStatus;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\SoftDelete;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\RestoreData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\ImportData;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Validations\BulkActionsValidation;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Validations\DataStoreValidation;
use App\Modules\Management\CourseManagement\CourseModuleClassResourse\Actions\BulkActions;
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