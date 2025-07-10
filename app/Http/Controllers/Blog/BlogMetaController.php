<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog\BlogMeta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class BlogMetaController extends Controller
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

        $query = BlogMeta::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('blog_id', '%' . $key . '%')
                    ->orWhere('title', '%' . $key . '%')
                    ->orWhere('description', '%' . $key . '%')
                    ->orWhere('keywords', '%' . $key . '%')
                    ->orWhere('image', '%' . $key . '%')
                    ->orWhere('image_alter_text', '%' . $key . '%')
                    ->orWhere('image_title', '%' . $key . '%');


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
        $data = BlogMeta::where('id', $id)
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
            'blog_id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'keywords' => ['required'],
            'image' => ['required'],
            'image_alter_text' => ['required'],
            'image_title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BlogMeta();
        $data->blog_id = request()->blog_id;
        $data->title = request()->title;
        $data->description = request()->description;
        $data->keywords = request()->keywords;
        $data->image_alter_text = request()->image_alter_text;
        $data->image_title = request()->image_title;

        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'blog_id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'keywords' => ['required'],
            'image' => ['required'],
            'image_alter_text' => ['required'],
            'image_title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new BlogMeta();
        $data->blog_id = request()->blog_id;
        $data->title = request()->title;
        $data->description = request()->description;
        $data->keywords = request()->keywords;
        $data->image_alter_text = request()->image_alter_text;
        $data->image_title = request()->image_title;

        $data->save();

        if (request()->hasFile('image')) {
            // 
        }


        return response()->json($data, 200);
    }

    public function update()
    {
        $data = BlogMeta::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'blog_id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'keywords' => ['required'],
            'image' => ['required'],
            'image_alter_text' => ['required'],
            'image_title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->blog_id = request()->blog_id;
        $data->title = request()->title;
        $data->description = request()->description;
        $data->keywords = request()->keywords;
        $data->image_alter_text = request()->image_alter_text;
        $data->image_title = request()->image_title;

        $data->save();

        if (request()->hasFile('image')) {
            // 
        }

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = BlogMeta::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'blog_id' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'keywords' => ['required'],
            'image' => ['required'],
            'image_alter_text' => ['required'],
            'image_title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->blog_id = request()->blog_id;
        $data->title = request()->title;
        $data->description = request()->description;
        $data->keywords = request()->keywords;
        $data->image_alter_text = request()->image_alter_text;
        $data->image_title = request()->image_title;

        $data->save();

        if (request()->hasFile('image')) {
            // 
        }


        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blog_metas,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BlogMeta::find(request()->id);
        $data->status ='inactive';
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:blog_metas,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = BlogMeta::find(request()->id);
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

        $data = BlogMeta::find(request()->id);
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
            $check = BlogMeta::where('id', $item->id)->first();
            if (!$check) {
                try {
                    BlogMeta::create((array) $item);
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
