<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class WebsiteStoryController extends Controller
{
    public function all() {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        // $status = 'active';
        if (request()->has('status') && request()->status == 1) {
            $status = 1;
        } else {
            $status = 0;
        }

        $query = SuccessStory::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%');
            });
        }

        $data = $query->paginate($paginate);
        return response()->json($data);
    }


    public function details($id) {
       
        $data = SuccessStory::where('id', $id)->first();

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
                        'data' => [],
                ],
            ], 404);
        }
    }


    public function store() {
        // dd(request()->all(), request()->files);
        $validator = Validator::make(request()->all(), [
            // 'title' => ['required'],
            'thumbnail_image' => ['image', 'required'],
            'video_link' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new SuccessStory();
        $data->title = request()->title ?? '';
        $data->video_link = request()->video_link ?? '';

        $data->save();


        if(request()->hasFile('thumbnail_image')) {
            $file = request()->file('thumbnail_image');
            $path = 'uploads/story/' . $data->id . rand(10000, 999999) . '.' . time() . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(400, 224)->save(public_path($path));
            $data->thumbnail_image = $path;
            $data->save();
        }

        // return response()->json($data, 200);
        return response()->json(
            [
                'data' => $data,
            ]
        , 200);

    }


    public function show_separate($id) {
        
        $data = SuccessStory::where('id', $id)->first();

        if ($data) {
            return response()->json([
                'data' => $data,
            ]
            , 200);
        } else {
            return response()->json([
                'err_message' => 'data not found',
                'errors' => [
                    'data' => [],
                ],
            ], 404);
        }

    }

    public function show($id) {
        
        $data = SuccessStory::where('id', $id)->first();

        if ($data) {
            return response()->json($data
            , 200);
        } else {
            return response()->json([
                'err_message' => 'data not found',
                'errors' => [
                    'data' => [],
                ],
            ], 404);
        }

    }

    
    public function update() {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            // 'title' => ['required'],
            'thumbnail_image' => ['image', 'required'],
            'video_link' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // $data = SuccessStory::find(request()->id);
        $data = SuccessStory::where('id', request()->id)->first();

        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        
        $data->fill(request()->except([
            'thumbnail_image'
        ]));
        // if(request()->has('title')) {
        //     $data->title = request()->title;
        //     $data->slug = Str::slug($data->title);
        // }


        $data->save();

        if(request()->hasFile('thumbnail_image')) {
            $fileName = $data->thumbnail_image;
            // if (File::exists($fileName)) {
            //     File::delete($fileName);
            // }
            // dd(public_path($fileName));
            if (file_exists(public_path($fileName))) {
                unlink(public_path($fileName));
            }

            $file = request()->file('thumbnail_image');
            $path = 'uploads/story/' . $data->id . rand(10000, 999999) . '.' . time() . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(1116, 372)->save(public_path($path));
            $data->thumbnail_image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }


    public function soft_delete() {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:success_stories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // $data = SuccessStory::find(request()->id);
        $data = SuccessStory::where('id', request()->id)->first();
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function restore() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:success_stories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = SuccessStory::where('id', request()->id)->first();
        $data->status = 1;
        $data->save();

        return response()->json([
                'result' => 'activated',
        ], 200);
    }


    public function destroy() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:website_banners,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // $data = SuccessStory::find(request()->id);
        $data = SuccessStory::where('id', request()->id)->first();
        $data->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }
    

}
