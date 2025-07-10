<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;
use App\Models\Course\Course;
use App\Models\Course\CourseMilestone;
use App\Models\Course\CourseModule;
use App\Models\Course\CourseModuleClasses;
use App\Models\Course\CourseModuleClassRoutines;
use Intervention\Image\Facades\Image;

class CourseModulesController extends Controller
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

        $query = CourseModule::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                ->orWhere('course_id', '%' . $key . '%')
                ->orWhere('module_no', '%' . $key . '%')
                ->orWhere('title', 'LIKE', '%' . $key . '%');
            });
        }

        $datas = $query->paginate($paginate);
        return response()->json($datas);
    }

    public function all_modules($course_id) {
        $course_batches = CourseModule::where('status', 'active')->where('course_id', $course_id)->orderBy('id', 'DESC')->get();
        return response()->json($course_batches);
    }

    public function show($id)
    {

        $select = "*";
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = CourseModule::where('id', $id)
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

    public function store_item() {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_no' => ['required'],
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModule();
        $data->course_id = request()->course_id;
        $data->module_no = request()->module_no;
        $data->milestone_id = request()->milestone_id;
        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function store()
    {
        // dd(request()->all());
        $modules = json_decode(request()->modules);
        $validator = Validator::make(request()->all(), [
            'modules' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        

        foreach($modules as $course_data) {
            // dd($course_data);
            $course_data = (object) $course_data;

            if(isset($course_data->id)){
                $milestone = CourseMilestone::find($course_data->id);
            }else{
                $milestone = new CourseMilestone();
            }

            $milestone->title = $course_data->title;
            $milestone->course_id = $course_data->course_id;
            $milestone->milestone_no = $course_data->milestone_no;
            $milestone->save();

            foreach ($course_data->modules as $key => $module) {
                $module = (object) $module;

                if(isset($data->id)){
                    $data = CourseModule::find($data->id);
                }else{
                    $data = new CourseModule();
                }

                $data->course_id = $course_data->course_id;
                $data->module_no = $module->module_no;
                $data->milestone_id = $milestone->id;
                $data->title = $module->title;
                $data->save();

                foreach($module->classes as $key => $class) {
                    $class = (object) $class;

                    if(isset($course_class->id)){
                        $course_class = CourseModuleClasses::find($course_class->id);
                    }else{
                        $course_class = new CourseModuleClasses();
                    }

                    $course_class->course_id = $course_data->course_id;
                    $course_class->milestone_id = $milestone->id;
                    $course_class->course_modules_id = $data->id;
                    $course_class->class_no = $class->class_no;
                    $course_class->title = $class->title;
                    $course_class->type = $class->type;
                    $course_class->class_video_link = $class->class_video_link;
                    $course_class->save();


                    if(request()->has('class_video_poster')) {
                        if(isset(request()->class_video_poster[$class->title])) {
                            $poster = request()->class_video_poster[$class->title];
                            try {
                                $path = 'uploads/class_video_thumbs/cp-' . $course_class->id . rand(1000, 9999) . '.';
                                
                                $path .= $poster->getClientOriginalExtension();

                                // dd($path, $poster);
                                Image::make($poster)->fit(720, 450)->save(public_path($path));
                                $course_class->class_video_poster = $path;
                                $course_class->save();
                            } catch (\Throwable $th) {
                                return response()->json("data created without image uploding-" . $th->getMessage(), 500);
                            }
                        }
                    }

                    $class_routines = (object) $class->routine;

                    if(isset($class->routine->id)){
                        $routine = CourseModuleClassRoutines::find($class->routine->id);
                    }else{
                        $routine = new CourseModuleClassRoutines();
                    }
                    
                    $routine->course_id = $course_data->course_id;
                    $routine->module_id = $data->id;
                    $routine->class_id = $course_class->id;
                    $routine->date = $class_routines->date;
                    $routine->time = $class_routines->time;
                    $routine->topic = $class_routines->topic;
                    $routine->save();
                }
            }
        }

        return response()->json(['message' => 'module updated successfully!'], 200);
    }

    public function update_modules() {
        foreach (request()->data as $key => $module) {
            $module = (object) $module;
            $module_check = CourseModule::where('course_id', $module->course_id)->where('id', $module->id)->first();

            if($module_check != null) {
                $module_check->title = $module->title;
                $module_check->module_no = $module->module_no;
                $module_check->save();
            }
        }
        return response()->json(["message" => "Course Module updated successfully!"], 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_no' => ['required'],
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseModule();
        $data->course_id = request()->course_id;
        $data->module_no = request()->module_no;
        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CourseModule::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_no' => ['required'],
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->module_no = request()->module_no;
        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CourseModule::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'module_no' => ['required'],
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->module_no = request()->module_no;
        $data->title = request()->title;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_modules,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModule::find(request()->id);
        $data->status = 'inactive';
        $data->save();

        return response()->json([
                'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_modules,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseModule::find(request()->id);
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

        $data = CourseModule::find(request()->id);
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

        foreach (request()->data as $course_data) {
            // $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']): Carbon::now()->toDateTimeString();
            // $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']): Carbon::now()->toDateTimeString();
            $course_data = (object) $course_data;
            $course_check = Course::where('title', $course_data->course_title)->first();
            
            
            // $check = CourseModule::where('id',$item->id)->first();
            if($course_check != null){
                
                try {
                    // checking if milestone exist
                    $check_milstone = CourseMilestone::where('title', $course_data->milestone_title)->first();
                    $milestone_no = CourseMilestone::latest()->first()->milestone_no;
    
                    if($check_milstone == null) {
                        $milestone = new CourseMilestone();
                        $milestone->title = $course_data->milestone_title;
                        $milestone->course_id = $course_check->id;
                        $milestone->milestone_no = $course_data->milestone_no;
                        $milestone->save();
                    }
                    
                    $check_module = CourseModule::where('title', $course_data->module_title)->first();
    
                    // dd($check_module, $course_check);
                    if($check_module == null) {
                        $data = new CourseModule();
                        $data->course_id = $course_check->id;
                        $data->module_no = $course_data->module_no;
                        $data->milestone_id = $check_milstone == null ? $milestone->id : $check_milstone->id;
                        $data->title = $course_data->module_title;
                        $data->save();
                    }
    
                    $class_check = CourseModuleClasses::where('title', $course_data->class_title)->first();
                    if($class_check == null) {
                        $course_class = new CourseModuleClasses();
                        $course_class->course_id = $course_check->id;
                        $course_class->milestone_id = $check_milstone == null ? $milestone->id : $check_milstone->id;
                        $course_class->course_modules_id = $check_module == null ? $data->id : $check_module->id;
                        $course_class->class_no = $course_data->class_no;
                        $course_class->title = $course_data->class_title;
                        $course_class->type = $course_data->type;
                        $course_class->class_video_link = $course_data->class_video_link;
                        $course_class->save();
                    }else {
                        $course_class = null;
                    }
    
                    // $class_date = Carbon::parse($course_data->date)->toDate();
                    // $routine_check = CourseModuleClassRoutines::where('course_id', $course_check->id)
                    // ->where('class_id', $course_class->id)
                    // ->where('date', $course_data->date)
                    // ->first();
    
    
                        // foreach($module->classes as $key => $class) {
                        //     $class = (object) $class;
                            
    
    
                            
    
                        //     $routine = new CourseModuleClassRoutines();
                        //     $class_routines = (object) $class->routine;
                        //     $routine->course_id = $course_data->course_id;
                        //     $routine->module_id = $data->id;
                        //     $routine->class_id = $course_class->id;
                        //     $routine->date = $class_routines->date;
                        //     $routine->time = $class_routines->time;
                        //     $routine->topic = $class_routines->topic;
                        //     $routine->save();
                        // }
                        
                    return response()->json(['message' => 'course uploaded successfully!'], 200);
                } catch (\Throwable $th) {
                    return response()->json([
                        'err_message' => 'validation error',
                        'errors' => $th->getMessage(),
                    ], 400);
                }
            }else {
                Course::create([
                    'title' => $course_data->title,
                    'image' =>'',
                    "type" => "online",
                    'intro_video' => '',
                    'what_is_this_course' => '',
                    'why_is_this_course' => '',
                    'published_at' => Carbon::today()
                ]);
            }
        }

        return response()->json('success', 200);
    }
}
