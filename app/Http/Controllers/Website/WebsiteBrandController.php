<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\WebsiteBrand;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class WebsiteBrandController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $query = WebsiteBrand::where('status', 1)->orderBy($orderBy, $orderByType);

        $data = $query->paginate($paginate);
        return response()->json($data);
    }

    // public function show($id)
    // {

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

    public function details($id) {
       
        $data = WebsiteBrand::where('id', $id)->first();

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


    public function store() {
        // dd(request()->all(), request()->files);
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

        $data = new WebsiteBrand();
        $data->title = request()->title;
        $data->save();

        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $path = 'uploads/brands/' . $data->id . rand(10000, 999999) . '.' . time() . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(193, 91)->save(public_path($path));
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


    public function show_separate($id) {
        
        $data = WebsiteBrand::where('id', $id)->first();

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

    
    public function update() {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'image' => ['image'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = WebsiteBrand::find(request()->id);

        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        
        if(request()->has('title')) {
            $data->title = request()->title;
        }
       
        $data->save();

        if(request()->hasFile('image')) {
            $fileName = $data->image;
            if (File::exists($fileName)) {
                File::delete($fileName);
            }

            $file = request()->file('image');
            $path = 'uploads/brands/' . $data->id . rand(10000, 999999) . '.' . time() . '.';
            
            $path .= $file->getClientOriginalExtension();
            Image::make($file)->fit(193, 91)->save(public_path($path));
            $data->image = $path;
            $data->save();
        }

        return response()->json($data, 200);
    }


    public function soft_delete() {
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:website_brands,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // $data = WebsiteBrand::find(request()->id);
        $data = WebsiteBrand::where('id', request()->all())->first();
        $data->status = 0;
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }
    

}
