<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Course\Course;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactMessage;
use Intervention\Image\Facades\Image;

class CourseController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 'active';
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = Course::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('title', '%' . $key . '%')
                    ->orWhere('status', '%' . $key . '%');
            });
        }

        $datas = $query->paginate($paginate);
        return response()->json($datas);
    }

    public function show($id)
    {

        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = Course::where('id', $id)
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

    public function details($id) {
       
        $data = Course::where('id', $id)->with(['course_batches', 'course_batches.course_instructors'])->first();

        if ($data) {
            // return response()->json($data, 200);
            return response()->json([
                    'data' => $data
                ]
            , 200);
        } else {
            return response()->json([
                    'err_message' => 'data not found',
                    'errors' => [
                        'user' => [],
                ],
            ], 404);
        }
    }

    public function full_module($id)
    {
        $data = Course::where('id', $id)
            ->with([
                'milestones' => function($q){
                    return $q->with([
                        'modules' => function($q){
                            return $q->with([
                                'classes' => function($q){
                                    return $q->with(['resource','routine']);
                                }   
                            ]);
                        }
                    ]);
                }    
            ])
            ->first()
            ->toArray();
        
        
        $data = (object) $data;
        foreach ($data->milestones as $mil_key => $milestone) {
            $milestone = (object) $milestone;
            foreach ($milestone->modules as $mod_key => $module) {
                $module = (object) $module;
                foreach ($module->classes as $cl_key => $class) {
                    $class = (object) $class;
                    if(!$class->routine){
                        $data->milestones[$mil_key]["modules"][$mod_key]["classes"][$cl_key]["routine"] = (object) [];
                    }
                }
            }
        }
        
        return response()->json($data);
    }

    public function store() {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'image' => ['required'],
            'intro_video' => ['required'],
            // 'what_is_this_course' => ['required'],
            'is_published' => ['required'],
            'published_at' => ['required'],
            // 'why_is_this_course' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Course();
        $data->title = request()->title;
        $data->intro_video = request()->intro_video;
        $data->type = request()->type;
        $data->is_published = request()->is_published;
        $data->published_at = request()->published_at;
        // $data->what_is_this_course = request()->what_is_this_course;
        // $data->why_is_this_course = request()->why_is_this_course;
        $data->save();

        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/course/cp-' . $data->id . rand(1000, 9999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(720, 450)->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        // return response()->json($data, 200);
        return response()->json(
            [
                'data' => $data,
            ]
        , 200);

    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'image' => ['required'],
            'intro_video' => ['required'],
            'what_is_this_course' => ['required'],
            'why_is_this_course' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Course();
        $data->title = request()->title;
        $data->intro_video = request()->intro_video;
        $data->what_is_this_course = request()->what_is_this_course;
        $data->why_is_this_course = request()->why_is_this_course;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function text_module()
    {
        $data = Course::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        } 
        $data->course_module_text = request()->course_module_text;
        $data->save();
        return response()->json($data, 200);
    }

    public function update()
    {
        $data = Course::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        if(request()->has('title')) {
            $data->title = request()->title;
        }
        if(request()->has('intro_video')) {
            $data->intro_video = request()->intro_video;
        }
        if(request()->has('what_is_this_course')) {
            $data->what_is_this_course = request()->what_is_this_course;
        }
        if(request()->has('why_is_this_course')) {
            $data->why_is_this_course = request()->why_is_this_course;
        }
        
        $data->save();

        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/course/cp-' . $data->id . rand(1000, 9999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(720, 450)->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = Course::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'intro_video' => ['required'],
            'what_is_this_course' => ['required'],
            'why_is_this_course' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->intro_video = request()->intro_video;
        $data->what_is_this_course = request()->what_is_this_course;
        $data->why_is_this_course = request()->why_is_this_course;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:courses,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Course::find(request()->id);
        $data->status ='inactive';
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:courses,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Course::find(request()->id);
        $data->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:contact_messages,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Course::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

    public function bulk_import()
    {
        $validator = Validator::make(request()->all(), [
            'data' => ['required', 'array'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        foreach (request()->data as $item) {
            $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']) : Carbon::now()->toDateTimeString();
            $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']) : Carbon::now()->toDateTimeString();
            $item = (object) $item;
            $check = Course::where('id', $item->id)->first();
            if (!$check) {
                try {
                    Course::create((array) $item);
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
