<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogsCategories;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class BlogCategoriesController extends Controller
{

    public function all() {
        // dd(request()->all());
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 'active';
        if (request()->has('status') && request()->status == 1) {
            $status = 'active';
        } else {
            $status = 'inactive';
        }

        // $status = "active";
        $query = BlogsCategories::where('status', $status)->orderBy($orderBy, $orderByType);

        // if( request()->search_key == '' || request()->search_key == null) {
        //     $datas = $query->paginate($paginate);
        //     return response()->json($datas);
        // }
       

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('title', $key)
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('id', 'LIKE', '%' . $key . '%');
                

            });
        }

        $datas = $query->paginate($paginate);
        return response()->json($datas);
    }

    public function show($id) {

        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = BlogsCategories::where('id', $id)
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

    public function store() {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            // 'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BlogsCategories();
        $data->title = request()->title;
        $data->save();

        // if(request()->hasFile('image')){
        //     $path = Storage::put('uploads/blog/', request()->file('image'));
        //     $data->image = $path;
        //     $data->save();
        // } else {
        //     $data->save();
        // }

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/blog/' . $data->id . rand(1000, 99999) . '.';
            $height = 200;
            $width = 200; 
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit($height, $width)->save(public_path($path));
            $data->image = $path;
        }

        // try {
        //     if (request()->hasFile('image')) {
        //         $file = request()->file('image');
        //         $path = 'uploads/blog/' . $data->id . rand(1000, 9999) . '.';
        //         $height = 300;
        //         $width = 200;
        //         if (count($file)) {
        //             foreach ($file as $s_file) {
        //                 $path .= $s_file->getClientOriginalExtension();
        //                 Image::make($s_file)->fit($height, $width)->save(public_path($path));
        //                 $data->image = $path;
        //             }
        //         } else {
        //             $path .= $file->getClientOriginalExtension();
        //             Image::make($file)->fit($height, $width)->save(public_path($path));
        //             $data->image = $path;
        //         }
        //     }
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return response()->json(["data created without image uploding-" . $th->getMessage(), 500]);
        // }

        $data->save();

        return response()->json($data, 200);

    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BlogsCategories();
        $data->title = request()->title;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function update() {
        $data = BlogsCategories::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            // 'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->save();

        // if (request()->hasFile('image')) {
            
        // }

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/blog/' . $data->id . rand(1000, 99999) . '.';
            $height = 200;
            $width = 200; 
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit($height, $width)->save(public_path($path));
            $data->image = $path;
        }

        // try {
        //     if (request()->hasFile('image')) {
        //         $file = request()->file('image');
        //         $path = 'uploads/blog/' . $data->id . rand(1000, 9999) . '.';
        //         $height = 200;
        //         $width = 200;
        //         if (count($file)) {
        //             foreach ($file as $s_file) {
        //                 $path .= $s_file->getClientOriginalExtension();
        //                 Image::make($s_file)->fit($height, $width)->save(public_path($path));
        //                 $data->image = $path;
        //             }
        //         } else {
        //             $path .= $file->getClientOriginalExtension();
        //             Image::make($file)->fit($height, $width)->save(public_path($path));
        //             $data->image = $path;
        //         }
        //     }
        // } catch (\Throwable $th) {
        //     //throw $th;
        //     return response()->json(["data created without image uploding-" . $th->getMessage(), 500]);
        // }

        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update() {
        $data = BlogsCategories::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'image' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }
        return response()->json($data, 200);
    }

    public function soft_delete() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blogs_categories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BlogsCategories::find(request()->id);
        $data->status ='inactive';
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blogs_categories,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BlogsCategories::find(request()->id);
        $data->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }

    public function restore() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:contact_messages,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BlogsCategories::find(request()->id);
        $data->status = 'active';
        $data->save();

        return response()->json([
            'result' => 'activated',
        ], 200);
    }

    public function bulk_import() {
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
            $check = BlogsCategories::where('id', $item->id)->first();
            if (!$check) {
                try {
                    BlogsCategories::create((array) $item);
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
