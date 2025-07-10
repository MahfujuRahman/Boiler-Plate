<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\Blogs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function all() {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 'active';
        if (request()->has('status') && request()->status == 1) {
            $status = 'active';
        } else {
            $status = 'inactive';
        }

        $query = Blogs::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('title', '%' . $key . '%')
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('short_description', 'LIKE', '%' . $key . '%')
                    ->orWhere('id', 'LIKE', '%' . $key . '%')
                    ->orWhere('description', 'LIKE', '%' . $key . '%');

            });
        }

        $datas = $query->paginate($paginate);
        return response()->json($datas);
    }

    public function show($id) {

        // $select = ["*"];
        // if (request()->has('select_all') && request()->select_all) {
        //     $select = "*";
        // }

        $data = Blogs::where('id', $id)->with(['category', 'tag', 'writer'])->first();

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
        // dd(request()->all(), request()->files);
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            // 'image' => ['required'],
            // 'published' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Blogs();
        $data->title = request()->title;
        $data->short_description = request()->short_description;
        $data->description = request()->description;
        $data->slug = Str::slug($data->title);

        

        $data->published = request()->has('published') ? 1 : 0;
        $data->is_featured = request()->has('is_featured') ? 1 : 0;

        // if(request()->is_featured == "on" || request()->is_featured == 1) {
        //     $data->is_featured = 1;
        // } else {
        //     $data->is_featured = 0;
        // }

        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/blog/' . $data->id . rand(1000, 99999) . '.';
            $height = 845;
            $width = 500; 
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit($height, $width)->save(public_path($path));
            $data->image = $path;
        }

        $data->category()->attach(request()->blog_category_ids);
        $data->tag()->attach(request()->blog_tag_ids);
        $data->writer()->attach(request()->blog_writer_ids);

        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
            'published' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Blogs();
        $data->title = request()->title;
        $data->short_description = request()->short_description;
        $data->description = request()->description;
        $data->published = request()->published;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function update() {
        // dd(request()->all(), request()->files);
        $data = Blogs::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            // 'image' => ['required'],
            // 'published' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->short_description = request()->short_description;
        $data->description = request()->description;    
        $data->published = request()->published;
        $data->slug = Str::slug($data->title);

        // if(request()->published == "on") {
        //     $data->published = 1;
        // } else {
        //     $data->published = 0;
        // }

        $data->published = request()->has('published') ? 1 : 0;
        $data->is_featured = request()->has('is_featured') ? 1 : 0;

        // if(request()->is_featured == "on" || request()->is_featured == 1) {
        //     $data->is_featured = 1;
        // } else {
        //     $data->is_featured = 0;
        // }

        $data->save();

        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/blog/' . $data->id . rand(1000, 99999) . '.';
            $height = 845;
            $width = 500; 
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit($height, $width)->save(public_path($path));
            $data->image = $path;
        }

        $data->category()->sync(request()->blog_category_ids);
        $data->tag()->sync(request()->blog_tag_ids);
        $data->writer()->sync(request()->blog_writer_ids);

        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update() {
        $data = Blogs::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'short_description' => ['required'],
            'description' => ['required'],
            'image' => ['required'],
            'published' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->short_description = request()->short_description;
        $data->description = request()->description;
        $data->published = request()->published;
        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function soft_delete() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blogs,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Blogs::find(request()->id);
        $data->status ='inactive';
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy() {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blogs,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Blogs::find(request()->id);
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

        $data = Blogs::find(request()->id);
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
            $check = Blogs::where('id', $item->id)->first();
            if (!$check) {
                try {
                    Blogs::create((array) $item);
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
