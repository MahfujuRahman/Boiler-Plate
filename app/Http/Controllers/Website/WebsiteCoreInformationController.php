<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteCoreInformation;
use Illuminate\Http\Request;
use Carbon\Carbon;
use File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class WebsiteCoreInformationController extends Controller
{
    public function all()
    {

        $data = WebsiteCoreInformation::where('status', 1)->first();
        
        return response()->json($data);
    }

    // public function show($id) {

    //     $select = ["*"];
    //     if (request()->has('select_all') && request()->select_all) {
    //         $select = "*";
    //     }
    //     $data = Course::where('id', $id)
    //         ->select($select)
    //         ->first();
    //     if ($data) {
    //         return response()->json($data, 200);
    //     } else {
    //         return response()->json([
    //             'err_message' => 'data not found',
    //             'errors' => [
    //                 'user' => [],
    //             ],
    //         ], 404);
    //     }
    // }

    // public function details($id) {
       
    //     $data = Course::where('id', $id)->with(['course_batches', 'course_batches.course_instructors'])->first();

    //     if ($data) {
    //         // return response()->json($data, 200);
    //         return response()->json([
    //                 'data' => $data
    //             ]
    //         , 200);
    //     } else {
    //         return response()->json([
    //                 'err_message' => 'data not found',
    //                 'errors' => [
    //                     'user' => [],
    //             ],
    //         ], 404);
    //     }
    // }

    // public function full_module($id) {
    //     $data = Course::where('id', $id)
    //         ->with([
    //             'milestones' => function($q){
    //                 return $q->with([
    //                     'modules' => function($q){
    //                         return $q->with([
    //                             'classes' => function($q){
    //                                 return $q->with(['resource','routine']);
    //                             }   
    //                         ]);
    //                     }
    //                 ]);
    //             }    
    //         ])
    //         ->first()
    //         ->toArray();
        
        
    //     $data = (object) $data;
    //     foreach ($data->milestones as $mil_key => $milestone) {
    //         $milestone = (object) $milestone;
    //         foreach ($milestone->modules as $mod_key => $module) {
    //             $module = (object) $module;
    //             foreach ($module->classes as $cl_key => $class) {
    //                 $class = (object) $class;
    //                 if(!$class->routine){
    //                     $data->milestones[$mil_key]["modules"][$mod_key]["classes"][$cl_key]["routine"] = (object) [];
    //                 }
    //             }
    //         }
    //     }
        
    //     return response()->json($data);
    // }

    // public function store() {
    //     // dd(request()->all());
    //     $validator = Validator::make(request()->all(), [
    //         'title' => ['required'],
    //         'image' => ['required'],
    //         'intro_video' => ['required'],
    //         // 'what_is_this_course' => ['required'],
    //         'is_published' => ['required'],
    //         'published_at' => ['required'],
    //         // 'why_is_this_course' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = new Course();
    //     $data->title = request()->title;
    //     $data->intro_video = request()->intro_video;
    //     $data->type = request()->type;
    //     $data->is_published = request()->is_published;
    //     $data->published_at = request()->published_at;
    //     // $data->what_is_this_course = request()->what_is_this_course;
    //     // $data->why_is_this_course = request()->why_is_this_course;
    //     $data->save();

    //     if(request()->hasFile('image')) {
    //         $file = request()->file('image');
    //         $path = 'uploads/course/cp-' . $data->id . rand(1000, 9999) . '.';
            
    //         $path .= $file->getClientOriginalExtension();
    //         Image::make($file)->fit(720, 450)->save(public_path($path));
    //         $data->image = $path;
    //         $data->save();
    //     }

    //     // return response()->json($data, 200);
    //     return response()->json(
    //         [
    //             'data' => $data,
    //         ]
    //     , 200);

    // }

    // public function canvas_store() {
    //     $validator = Validator::make(request()->all(), [
    //         'title' => ['required'],
    //         'image' => ['required'],
    //         'intro_video' => ['required'],
    //         'what_is_this_course' => ['required'],
    //         'why_is_this_course' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = new Course();
    //     $data->title = request()->title;
    //     $data->intro_video = request()->intro_video;
    //     $data->what_is_this_course = request()->what_is_this_course;
    //     $data->why_is_this_course = request()->why_is_this_course;
    //     $data->save();

    //     if (request()->hasFile('image')) {
    //         // 
    //     }

    //     return response()->json($data, 200);
    // }

    // public function text_module() {
    //     $data = Course::find(request()->id);
    //     if (!$data) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
    //         ], 422);
    //     } 
    //     $data->course_module_text = request()->course_module_text;
    //     $data->save();
    //     return response()->json($data, 200);
    // }

    public function update() {
        // dd(request()->all(), request()->files);
        $validator = Validator::make(request()->all(), [
            'aboutus_heading' => ['required'],
            'aboutus_description' => ['required'],
            'aboutus_moto_heading' => ['required'],
            'aboutus_moto_description' => ['required'],
            'aboutus_mission_heading' => ['required'],
            'aboutus_mission_description' => ['required'],
            // 'aboutus_mission_image' => ['required'],
            'aboutus_vision_heading' => ['required'],
            'aboutus_vision_description' => ['required'],
            // 'aboutus_vision_image' => ['required'],
            'aboutus_team_heading' => ['required'],
            'aboutus_team_description' => ['required'],
            'our_trainers_heading' => ['required'],
            'our_trainers_description' => ['required'],
            // 'our_trainers_cover' => ['required'],
            'our_training_heading' => ['required'],
            'our_training_description' => ['required'],
            'our_brand_heading' => ['required'],
            'our_brand_description' => ['required'],
            // 'header_logo' => ['required'],
            // 'footer_logo' => ['required'],
            // 'fabicon' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = WebsiteCoreInformation::find(request()->id);

        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $data->aboutus_heading = request()->aboutus_heading;
        $data->aboutus_description = request()->aboutus_description;
        $data->aboutus_moto_heading = request()->aboutus_moto_heading;
        $data->aboutus_moto_description = request()->aboutus_moto_description;
        $data->aboutus_mission_heading = request()->aboutus_mission_heading;
        $data->aboutus_mission_description = request()->aboutus_mission_description;
        $data->aboutus_vision_heading = request()->aboutus_vision_heading;
        $data->aboutus_vision_description = request()->aboutus_vision_description;
        $data->aboutus_team_heading = request()->aboutus_team_heading;
        $data->aboutus_team_description = request()->aboutus_team_description;
        $data->our_trainers_heading = request()->our_trainers_heading;
        $data->our_trainers_description = request()->our_trainers_description;
        $data->our_training_heading = request()->our_training_heading;
        $data->our_training_description = request()->our_training_description;
        $data->our_brand_heading = request()->our_brand_heading;
        $data->our_brand_description = request()->our_brand_description;
        $data->terms_condition = request()->terms_condition;
        $data->cookies_policy = request()->cookies_policy;
        $data->privacy_policy = request()->privacy_policy;
        $data->refund_policy = request()->refund_policy;
        $data->affiliation = request()->affiliation;
        
        $data->save();

        if(request()->hasFile('mission_image')) {
            $fileName = $data->aboutus_mission_image;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('mission_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(409, 367)->save(public_path($path));
            $data->aboutus_mission_image = $path;
            $data->save();
        }

        if(request()->hasFile('vision_image')) {
            $fileName = $data->aboutus_vision_image;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('vision_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(597, 384)->save(public_path($path));
            $data->aboutus_vision_image = $path;
            $data->save();
        }

        if(request()->hasFile('trainer_cover_image')) {
            $fileName = $data->our_trainers_cover;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('trainer_cover_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(1240, 944)->save(public_path($path));
            $data->our_trainers_cover = $path;
            $data->save();
        }

        if(request()->hasFile('login_page_image')) {
            $fileName = $data->login_image;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('login_page_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(409, 367)->save(public_path($path));
            $data->login_image = $path;
            $data->save();
        }

        if(request()->hasFile('header_logo_image')) {
            $fileName = $data->header_logo;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('header_logo_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(414, 102)->save(public_path($path));
            $data->header_logo = $path;
            $data->save();
        }

        if(request()->hasFile('footer_logo_image')) {
            $fileName = $data->footer_logo;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('footer_logo_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(414, 102)->save(public_path($path));
            $data->footer_logo = $path;
            $data->save();
        }

        if(request()->hasFile('fabicon_image')) {
            $fileName = $data->fabicon;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }

            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('fabicon_image');
            $path = 'uploads/aboutus/' . $data->id . rand(10000, 999999) . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(16, 16)->save(public_path($path));
            $data->fabicon = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }

    // public function canvas_update() {
    //     $data = Course::find(request()->id);
    //     if (!$data) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
    //         ], 422);
    //     }

    //     $validator = Validator::make(request()->all(), [
    //         'title' => ['required'],
    //         'intro_video' => ['required'],
    //         'what_is_this_course' => ['required'],
    //         'why_is_this_course' => ['required'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data->title = request()->title;
    //     $data->intro_video = request()->intro_video;
    //     $data->what_is_this_course = request()->what_is_this_course;
    //     $data->why_is_this_course = request()->why_is_this_course;
    //     $data->save();

    //     if (request()->hasFile('image')) {
    //         // 
    //     }

    //     return response()->json($data, 200);
    // }

    // public function soft_delete() {
    //     $validator = Validator::make(request()->all(), [
    //         'id' => ['required', 'exists:website_core_information,id'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = WebsiteCoreInformation::find(request()->id);
    //     $data->status ='inactive';
    //     $data->save();

    //     return response()->json([
    //         'result' => 'deactivated',
    //     ], 200);
    // }

    // public function destroy() {
    //     $validator = Validator::make(request()->all(), [
    //         'id' => ['required', 'exists:courses,id'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = Course::find(request()->id);
    //     $data->delete();

    //     return response()->json([
    //         'result' => 'deleted',
    //     ], 200);
    // }

    // public function restore() {
    //     $validator = Validator::make(request()->all(), [
    //         'id' => ['required', 'exists:contact_messages,id'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     $data = Course::find(request()->id);
    //     $data->status = 'active';
    //     $data->save();

    //     return response()->json([
    //         'result' => 'activated',
    //     ], 200);
    // }

    // public function bulk_import() {
    //     $validator = Validator::make(request()->all(), [
    //         'data' => ['required', 'array'],
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'err_message' => 'validation error',
    //             'errors' => $validator->errors(),
    //         ], 422);
    //     }

    //     foreach (request()->data as $item) {
    //         $item['created_at'] = $item['created_at'] ? Carbon::parse($item['created_at']) : Carbon::now()->toDateTimeString();
    //         $item['updated_at'] = $item['updated_at'] ? Carbon::parse($item['updated_at']) : Carbon::now()->toDateTimeString();
    //         $item = (object) $item;
    //         $check = Course::where('id', $item->id)->first();
    //         if (!$check) {
    //             try {
    //                 Course::create((array) $item);
    //             } catch (\Throwable $th) {
    //                 return response()->json([
    //                     'err_message' => 'validation error',
    //                     'errors' => $th->getMessage(),
    //                 ], 400);
    //             }
    //         }
    //     }

    //     return response()->json('success', 200);
    // }


}
