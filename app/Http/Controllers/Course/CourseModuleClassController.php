<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;
use App\Models\Course\CourseModuleClasses;
use App\Models\Course\CourseModuleClassQuizes;
use App\Models\Course\CourseModuleClassRoutines;
use Intervention\Image\Facades\Image;

class CourseModuleClassController extends Controller
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

        $query = CourseModuleClasses::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('course_id', '%' . $key . '%')
                    ->orWhere('course_modules_id', '%' . $key . '%')
                    ->orWhere('class_no', '%' . $key . '%')
                    ->orWhere('title', '%' . $key . '%')
                    ->orWhere('type', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_video_link', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_video_poster', 'LIKE', '%' . $key . '%');
            });
        }

        $datas = $query->with(['module'])->paginate($paginate);
        return response()->json($datas);
    }

    public function all_module_classes($course_id) {
        $course_classes = CourseModuleClasses::where('status', 'active')
            ->where('course_id', $course_id)
            ->orderBy('id', 'DESC')
            ->with(['module', 'routine'])
            ->paginate(10);
        return response()->json($course_classes);
    }

    public function update_class_module() {
        foreach (request()->data as $key => $module_class) {
            // dd($module_class->routine->time);
            $module_class = (object) $module_class;
            $module_class_check = CourseModuleClasses::where('course_id', $module_class->course_id)->where('id', $module_class->id)->first();

            if($module_class_check != null) {
                $module_class_check->title = $module_class->title;
                $module_class_check->class_no = $module_class->class_no;
                $module_class_check->type = $module_class->type;
                $module_class_check->class_video_link = $module_class->class_video_link;
                $module_class_check->save();

                $routine = (object) $module_class->routine;
                $class_routine = CourseModuleClassRoutines::where('class_id', $module_class_check->id)->first();
                if($class_routine != null) {
                    // dd($routine->topic);
                    $class_routine->course_id = $module_class_check->course_id;
                    $class_routine->module_id = $module_class_check->course_modules_id;
                    $class_routine->class_id = $module_class_check->id;
                    $class_routine->topic = $routine->topic;
                    $class_routine->date = $routine->show_date;
                    $class_routine->time = $routine->time;
                    $class_routine->save();
                }
            }
        }
        return response()->json(["message" => "Course uploaded successfully!"], 200);
    }

    public function add_quiz()  {
        $validator = Validator::make(request()->all(), [
            'class_id' => ['required'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }   
        $class_details = CourseModuleClasses::where('id', request()->class_id)->first();

        foreach (request()->quizes as $key => $quiz) {
            $quiz = (object) $quiz; 
            $quiz_check = CourseModuleClassQuizes::where('quiz_id', $quiz->id)->first();
            if($quiz_check != null) {
                $quiz_check->course_id = $class_details->course_id;
                $quiz_check->course_module_id = $class_details->course_modules_id;
                $quiz_check->course_module_class_id = $class_details->id;
                $quiz_check->quiz_id = $quiz->id;
                $quiz_check->save();
            }else {
                $class_quiz = new CourseModuleClassQuizes();
                $class_quiz->course_id = $class_details->course_id;
                $class_quiz->course_module_id = $class_details->course_modules_id;
                $class_quiz->course_module_class_id = $class_details->id;
                $class_quiz->quiz_id = $quiz->id;
                $class_quiz->save();
            }
        }

        return response()->json(['message' => 'course class quiz updated successfully!', 200]);
    }

    public function update_image() {
        $course_class = json_decode(request()->course);
        if(request()->hasFile('banner')) {
            $course_class_check = CourseModuleClasses::where('course_id', $course_class->course_id)->where('id', $course_class->id)->first();

            if($course_class_check != null) {
                
                $file = request()->file('banner');
                $path = 'uploads/class_video_thumbs/cp-' . $course_class_check->id . rand(1000, 9999) . '.';
                
                $path .= $file->getClientOriginalExtension();
                Image::make($file)->fit(720, 450)->save(public_path($path));
                $course_class_check->class_video_poster = $path;
                $course_class_check->save();

                return response()->json([
                    'message' => 'image updated successfully!',
                ], 200);
            }
        }else {
            return response()->json([
                'message' => 'image not found!',
            ], 422);
        }
    }

    public function show($id)
    {

        $select = "*";
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = CourseModuleClasses::where('id', $id)
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
            'milestone_id' => ['required'],
            'course_modules_id' => ['required'],
            // 'class_no' => ['required'],
            'title' => ['required'],
            'type' => ['required'],
            // 'class_video_link' => ['required'],
            // 'date' => ['required'],
            // 'time' => ['required']

        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleClasses();
        $data->course_id = request()->course_id;
        $data->milestone_id = request()->milestone_id;
        $data->course_modules_id = request()->course_modules_id;
        $data->class_no = request()->class_no;
        $data->title = request()->title;
        $data->type = request()->type;
        $data->class_video_link = request()->class_video_link;
        $data->save();

        $routine = new CourseModuleClassRoutines();
        $routine->course_id = request()->course_id;
        $routine->module_id = request()->course_modules_id;
        $routine->class_id = $data->id;
        $routine->topic = request()->title;
        $routine->date = request()->date;
        $routine->time = request()->time;
        $routine->save();

        if(request()->hasFile('class_video_poster')) {
            $file = request()->file('class_video_poster');
            $path = 'uploads/class_video_thumbs/cp-' . $data->id . rand(1000, 9999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(720, 450)->save(public_path($path));
            $data->class_video_poster = $path;
            $data->save();
        }
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'course_modules_id' => ['required'],
            'class_no' => ['required'],
            'title' => ['required'],
            'type' => ['required'],
            'class_video_link' => ['required'],
            'class_video_poster' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModuleClasses();
        $data->course_id = request()->course_id;
        $data->course_modules_id = request()->course_modules_id;
        $data->class_no = request()->class_no;
        $data->title = request()->title;
        $data->type = request()->type;
        $data->class_video_link = request()->class_video_link;
        $data->class_video_poster = request()->class_video_poster;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CourseModuleClasses::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'course_modules_id' => ['required'],
            'class_no' => ['required'],
            'title' => ['required'],
            'type' => ['required'],
            'class_video_link' => ['required'],
            'class_video_poster' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->course_modules_id = request()->course_modules_id;
        $data->class_no = request()->class_no;
        $data->title = request()->title;
        $data->type = request()->type;
        $data->class_video_link = request()->class_video_link;
        $data->class_video_poster = request()->class_video_poster;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CourseModuleClasses::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'course_modules_id' => ['required'],
            'class_no' => ['required'],
            'title' => ['required'],
            'type' => ['required'],
            'class_video_link' => ['required'],
            'class_video_poster' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $data->course_id = request()->course_id;
        $data->course_modules_id = request()->course_modules_id;
        $data->class_no = request()->class_no;
        $data->title = request()->title;
        $data->type = request()->type;
        $data->class_video_link = request()->class_video_link;
        $data->class_video_poster = request()->class_video_poster;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_classes,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleClasses::find(request()->id);
        $data->status = 'inactive';
        $data->save();

        return response()->json([
                'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_module_classes,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModuleClasses::find(request()->id);
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

        $data = CourseModuleClasses::find(request()->id);
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
            $check = CourseModuleClasses::where('id',$item->id)->first();
            if(!$check){
                try {
                    CourseModuleClasses::create((array) $item);
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
