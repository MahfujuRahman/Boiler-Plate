<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Models\Course\CourseModuleTaskCompleteByUsers;
use Illuminate\Support\Facades\Validator;

class CourseModuleTaskCompleteByUsersController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 1;
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = CourseModuleTaskCompleteByUsers::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('course_id', '%' . $key . '%')
                    ->orWhere('module_id', '%' . $key . '%')
                    ->orWhere('class_id', '%' . $key . '%')
                    ->orWhere('user_id', '%' . $key . '%')
                    ->orWhere('quiz_id', 'LIKE', '%' . $key . '%')
                    ->orWhere('exam_id', 'LIKE', '%' . $key . '%');
       
            });
        }

        $datas = $query->paginate($paginate);
        return response()->json($datas);
    }

    public function show($id)
    {

        $select = "*";
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = CourseModuleTaskCompleteByUsers::where('id', $id)
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
            'user_id' => ['required'],
            'quiz_id' => ['required'],
            'exam_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleTaskCompleteByUsers();
        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->user_id = request()->user_id;
        $data->quiz_id = request()->quiz_id;
        $data->exam_id = request()->exam_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_id' => ['required'],
            'class_id' => ['required'],
            'user_id' => ['required'],
            'quiz_id' => ['required'],
            'exam_id' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleTaskCompleteByUsers();
        $data->course_id = request()->course_id;
        $data->module_id = request()->module_id;
        $data->class_id = request()->class_id;
        $data->user_id = request()->user_id;
        $data->quiz_id = request()->quiz_id;
        $data->exam_id = request()->exam_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CourseModuleTaskCompleteByUsers::find(request()->id);
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
            'user_id' => ['required'],
            'quiz_id' => ['required'],
            'exam_id' => ['required'],
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
        $data->user_id = request()->user_id;
        $data->quiz_id = request()->quiz_id;
        $data->exam_id = request()->exam_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CourseModuleTaskCompleteByUsers::find(request()->id);
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
            'user_id' => ['required'],
            'quiz_id' => ['required'],
            'exam_id' => ['required'],
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
        $data->user_id = request()->user_id;
        $data->quiz_id = request()->quiz_id;
        $data->exam_id = request()->exam_id;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_task_complete_by_users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleTaskCompleteByUsers::find(request()->id);
        $data->status = 'inactive';
        $data->save();

        return response()->json([
                'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_task_complete_by_users,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleTaskCompleteByUsers::find(request()->id);
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

        $data = CourseModuleTaskCompleteByUsers::find(request()->id);
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
            $check = CourseModuleTaskCompleteByUsers::where('id',$item->id)->first();
            if(!$check){
                try {
                    CourseModuleTaskCompleteByUsers::create((array) $item);
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
