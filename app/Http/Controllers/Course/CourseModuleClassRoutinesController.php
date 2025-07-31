<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;
use App\Models\Course\CourseModuleClassRoutines;

class CourseModuleClassRoutinesController extends Controller
{
    // public function all()
    // {
    //     $paginate = (int) request()->paginate ?? 10;
    //     $orderBy = request()->orderBy ?? 'id';
    //     $orderByType = request()->orderByType ?? 'ASC';

    //     $status = 1;
    //     if (request()->has('status')) {
    //         $status = request()->status;
    //     }

    //     $query = CourseModuleClassRoutines::where('status', $status)->orderBy($orderBy, $orderByType);

    //     if (request()->has('search_key')) {
    //         $key = request()->search_key;
    //         $query->where(function ($q) use ($key) {
    //             return $q->where('id', '%' . $key . '%')
    //                 ->orWhere('course_id', '%' . $key . '%')
    //                 ->orWhere('module_id', '%' . $key . '%')
    //                 ->orWhere('class_id', '%' . $key . '%')
    //                 ->orWhere('date', '%' . $key . '%')
    //                 ->orWhere('time', 'LIKE', '%' . $key . '%')
    //                 ->orWhere('topic', 'LIKE', '%' . $key . '%');
              
    //         });
    //     }

    //     $datas = $query->paginate($paginate);
    //     return response()->json($datas);
    // }

    public function all($course_id)
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 1;
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = CourseModuleClassRoutines::where('status', $status)->where('course_id', $course_id)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('date','LIKE', '%' . $key . '%')
                    ->orWhere('time', 'LIKE', '%' . $key . '%')
                    ->orWhere('topic', 'LIKE', '%' . $key . '%')
                    ->orWhereHas('class', function ($q) use ($key) {
                        $q->where('title', 'LIKE', '%' . $key . '%')
                        ->orWhere('type', 'LIKE', '%' . $key . '%');
                    });
            });
        }

        if(request()->has('module_id')) {
            $module_id = (int) request()->module_id;
            $query->where('module_id', $module_id);
        }

        $datas = $query->with('class')->paginate($paginate);
        return response()->json($datas);
    }

    public function show($id)
    {

        $select = "*";
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = CourseModuleClassRoutines::where('id', $id)
            ->select($select)
            ->first();
        if ($data) {
            return response()->json($data, 200);
        } else {
            return response()->json([
                'err_message' => 'data not found',
                'errors' => [
                    'user' => [],
                ],
            ], 404);
        }
    }
    public function store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_id' => ['required'],
            'class_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'topic' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleClassRoutines();
        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->date = request()->date;
        $data->time = request()->time;
        $data->topic = request()->topic;
        $data->save();

        return response()->json($data, 200);
    }

    public function store_all() {
        foreach (request()->data as $key => $routine) {
            // dd($routine);
            $routine = (object) $routine;
            $routine_check = CourseModuleClassRoutines::where('course_id', $routine->course_id)->where('module_id', $routine->module_id)
            ->where('class_id', $routine->class_id)->first();

            if($routine_check != null) {
                $routine_check->date = $routine->show_date;
                $routine_check->time = $routine->time;
                $routine_check->topic = $routine->topic;
                $routine_check->save();
            }
        }
        return response()->json(["message" => "Course uploaded successfully!"], 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_id' => ['required'],
            'class_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'topic' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleClassRoutines();
        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->date = request()->date;
        $data->time = request()->time;
        $data->topic = request()->topic;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CourseModuleClassRoutines::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_id' => ['required'],
            'class_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'topic' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->date = request()->date;
        $data->time = request()->time;
        $data->topic = request()->topic;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CourseModuleClassRoutines::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_id' => ['required'],
            'class_id' => ['required'],
            'date' => ['required'],
            'time' => ['required'],
            'topic' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->date = request()->date;
        $data->time = request()->time;
        $data->topic = request()->topic;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_class_routines,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleClassRoutines::find(request()->id);
        $data->status = 'inactive';
        $data->save();

        return response()->json([
                'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_class_routines,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleClassRoutines::find(request()->id);
        $data->delete();

        return response()->json([
                'result' => 'deleted',
        ], 200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:contact_messages,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleClassRoutines::find(request()->id);
        $data->status = 1;
        $data->save();

        return response()->json([
                'result' => 'activated',
        ], 200);
    }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required','array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']): Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']): Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = CourseModuleClassRoutines::where('id',$item->id)->first();
            if(!$check){
                try {
                    CourseModuleClassRoutines::create((array) $item);
                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }
        }

        return response()->json('success', 200);
    }
}
