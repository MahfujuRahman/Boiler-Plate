<?php

namespace App\Http\Controllers\Seminar;

use App\Http\Controllers\Controller;
use App\Models\Seminars\Seminars;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeminarController extends Controller
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

        $query = Seminars::where('status', $status)->orderBy($orderBy, $orderByType);

        // if (request()->has('search_key')) {
        //     $key = request()->search_key;
        //     $query->where(function ($q) use ($key) {
        //         return $q->where('id', '%' . $key . '%')
        //             ->orWhere('title', '%' . $key . '%')
        //             ->orWhere('details', '%' . $key . '%')
        //             ->orWhere('date_time', '%' . $key . '%');
        //     });
        // }

        $data = $query->paginate($paginate);
        return response()->json($data);
    }

    // public function show($id) {

    //     $select = ["*"];
    //     if (request()->has('select_all') && request()->select_all) {
    //         $select = "*";
    //     }
    //     $data = Seminars::where('id', $id)
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

    public function show($id) {

        $data = Seminars::where('id', $id)->first();

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

    public function show_separate($id) {
        
        $seminar = Seminars::where('id', $id)->first();

        if ($seminar) {
            return response()->json([
                'seminar' => $seminar,
            ]
            , 200);
        } else {
            return response()->json([
                'err_message' => 'data not found',
                'errors' => [
                    'seminar' => [],
                ],
            ], 404);
        }

    }

    public function store() {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'details' => ['required'],
            'date_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new Seminars();
        $data->title = request()->title;
        $data->whatsapp_group = request()->whatsapp_group ?? '';
        $data->facebook_group = request()->facebook_group ?? '';
        $data->telegram_group = request()->telegram_group ?? '';
        $data->details = request()->details;
        $data->promo_video = request()->promo_video ?? '';
        $data->date_time = request()->date_time;
        // $data->save();

        if(request()->hasFile('poster')){
            $path = Storage::put('uploads/seminars', request()->file('poster'));
            $data->poster = $path;
            $data->save();
        } else {
            $data->save();
        }


        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'details' => ['required'],
            'date_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }
        $data = new Seminars();
        $data->title = request()->title;
        $data->details = request()->details;
        $data->date_time = request()->date_time;
        $data->save();

        return response()->json($data, 200);
    }

    public function update() {

        $data = Seminars::find(request()->id);

        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'details' => ['required'],
            'date_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->whatsapp_group = request()->whatsapp_group ?? '';
        $data->facebook_group = request()->facebook_group ?? '';
        $data->telegram_group = request()->telegram_group ?? '';
        $data->details = request()->details;
        $data->promo_video = request()->promo_video ?? '';
        $data->date_time = request()->date_time;
        // $data->save();

        if(request()->hasFile('poster')){
            $path = Storage::put('uploads/seminars', request()->file('poster'));
            $data->poster = $path;
            $data->save();
        } else {
            $data->save();
        }

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = Seminars::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
            'details' => ['required'],
            'date_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->title = request()->title;
        $data->details = request()->details;
        $data->date_time = request()->date_time;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:seminars,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Seminars::find(request()->id);
        $data->status ='inactive';
        $data->save();

        return response()->json([
            'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:seminars,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Seminars::find(request()->id);
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

        $data = Seminars::find(request()->id);
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
            $check = Seminars::where('id', $item->id)->first();
            if (!$check) {
                try {
                    Seminars::create((array) $item);
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
