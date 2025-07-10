<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Course\CourseBatches;
use App\Models\Course\CourseCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseBatchController extends Controller
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

        $query = CourseBatches::where('status', $status)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('course_id', '%' . $key . '%')
                    ->orWhere('batch_name', '%' . $key . '%')
                    ->orWhere('admission_start_date', '%' . $key . '%')
                    ->orWhere('admission_end_date', '%' . $key . '%')
                    ->orWhere('batch_student_limit', 'LIKE', '%' . $key . '%')
                    ->orWhere('seat_booked', 'LIKE', '%' . $key . '%')
                    ->orWhere('course_price', 'LIKE', '%' . $key . '%')
                    ->orWhere('course_discount', 'LIKE', '%' . $key . '%')
                    ->orWhere('after_discount_price', 'LIKE', '%' . $key . '%')
                    ->orWhere('first_class_date', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_days', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_start_time', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_end_time', 'LIKE', '%' . $key . '%');

            });
        }

        $datas = $query->with(['course'])->paginate($paginate);
        return response()->json($datas);
    }

    public function course_batches($course_id)
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $status = 'active';
        if (request()->has('status')) {
            $status = request()->status;
        }

        $query = CourseBatches::where('status', $status)->where('course_id', $course_id)->orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('course_id', '%' . $key . '%')
                    ->orWhere('batch_name', '%' . $key . '%')
                    ->orWhere('admission_start_date', '%' . $key . '%')
                    ->orWhere('admission_end_date', '%' . $key . '%')
                    ->orWhere('batch_student_limit', 'LIKE', '%' . $key . '%')
                    ->orWhere('seat_booked', 'LIKE', '%' . $key . '%')
                    ->orWhere('course_price', 'LIKE', '%' . $key . '%')
                    ->orWhere('course_discount', 'LIKE', '%' . $key . '%')
                    ->orWhere('after_discount_price', 'LIKE', '%' . $key . '%')
                    ->orWhere('first_class_date', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_days', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_start_time', 'LIKE', '%' . $key . '%')
                    ->orWhere('class_end_time', 'LIKE', '%' . $key . '%');

            });
        }

        $datas = $query->with(['course'])->paginate($paginate);
        return response()->json($datas);
    }

    public function get_all_bacths($course_id)
    {
        $course_batches = CourseBatches::where('status', 'active')->where('course_id', $course_id)->orderBy('id', 'DESC')->get();
        return response()->json($course_batches);
    }

    public function show($id)
    {

        $select = "*";
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = CourseBatches::where('id', $id)
            ->select($select)
            ->with(['course'])
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
            'batch_name' => ['required'],
            'admission_start_date' => ['required'],
            'admission_end_date' => ['required'],
            'batch_student_limit' => ['required'],
            'seat_booked' => ['required'],
            'course_price' => ['required'],
            'course_discount' => ['required'],
            'after_discount_price' => ['required'],
            'first_class_date' => ['required'],
            'class_days' => ['required'],
            'class_start_time' => ['required'],
            'class_end_time' => ['required'],

        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseBatches();
        $data->course_id = request()->course_id;
        $data->batch_name = request()->batch_name;
        $data->admission_start_date = request()->admission_start_date;
        $data->admission_end_date = request()->admission_end_date;
        $data->batch_student_limit = request()->batch_student_limit;
        $data->seat_booked = request()->seat_booked;
        $data->booked_percent = request()->booked_percent;
        $data->course_price = request()->course_price;
        $data->course_discount = request()->course_discount;
        $data->after_discount_price = request()->after_discount_price;
        $data->first_class_date = request()->first_class_date;
        $data->class_days = request()->class_days;
        $data->class_start_time = request()->class_start_time;
        $data->class_end_time = request()->class_end_time;

        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_store()
    {
        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'batch_name' => ['required'],
            'admission_start_date' => ['required'],
            'admission_end_date' => ['required'],
            'batch_student_limit' => ['required'],
            'seat_booked' => ['required'],
            'course_price' => ['required'],
            'course_discount' => ['required'],
            'after_discount_price' => ['required'],
            'first_class_date' => ['required'],
            'class_days' => ['required'],
            'class_start_time' => ['required'],
            'class_end_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = new CourseBatches();
        $data->course_id = request()->course_id;
        $data->batch_name = request()->batch_name;
        $data->admission_start_date = request()->admission_start_date;
        $data->admission_end_date = request()->admission_end_date;
        $data->batch_student_limit = request()->batch_student_limit;
        $data->seat_booked = request()->seat_booked;
        $data->course_price = request()->course_price;
        $data->course_discount = request()->course_discount;
        $data->after_discount_price = request()->after_discount_price;
        $data->first_class_date = request()->first_class_date;
        $data->class_days = request()->class_days;
        $data->class_start_time = request()->class_start_time;
        $data->class_end_time = request()->class_end_time;
        $data->save();

        return response()->json($data, 200);
    }

    public function update()
    {
        $data = CourseBatches::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['course_batches not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'batch_name' => ['required'],
            'admission_start_date' => ['required'],
            'admission_end_date' => ['required'],
            'batch_student_limit' => ['required'],
            'seat_booked' => ['required'],
            'course_price' => ['required'],
            'course_discount' => ['required'],
            'after_discount_price' => ['required'],
            'first_class_date' => ['required'],
            'class_days' => ['required'],
            'class_start_time' => ['required'],
            'class_end_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->batch_name = request()->batch_name;
        $data->admission_start_date = request()->admission_start_date;
        $data->admission_end_date = request()->admission_end_date;
        $data->batch_student_limit = request()->batch_student_limit;
        $data->seat_booked = request()->seat_booked;
        $data->booked_percent = request()->booked_percent;
        $data->course_price = request()->course_price;
        $data->course_discount = request()->course_discount;
        $data->after_discount_price = request()->after_discount_price;
        $data->first_class_date = request()->first_class_date;
        $data->class_days = request()->class_days;
        $data->class_start_time = request()->class_start_time;
        $data->class_end_time = request()->class_end_time;
        $data->save();

        return response()->json($data, 200);
    }

    public function canvas_update()
    {
        $data = CourseBatches::find(request()->id);
        if(!$data){
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name'=>['user_role not found by given id '.(request()->id?request()->id:'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'course_id' => ['required'],
            'batch_name' => ['required'],
            'admission_start_date' => ['required'],
            'admission_end_date' => ['required'],
            'batch_student_limit' => ['required'],
            'seat_booked' => ['required'],
            'course_price' => ['required'],
            'course_discount' => ['required'],
            'after_discount_price' => ['required'],
            'first_class_date' => ['required'],
            'class_days' => ['required'],
            'class_start_time' => ['required'],
            'class_end_time' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data->course_id = request()->course_id;
        $data->batch_name = request()->batch_name;
        $data->admission_start_date = request()->admission_start_date;
        $data->admission_end_date = request()->admission_end_date;
        $data->batch_student_limit = request()->batch_student_limit;
        $data->seat_booked = request()->seat_booked;
        $data->course_price = request()->course_price;
        $data->course_discount = request()->course_discount;
        $data->after_discount_price = request()->after_discount_price;
        $data->first_class_date = request()->first_class_date;
        $data->class_days = request()->class_days;
        $data->class_start_time = request()->class_start_time;
        $data->class_end_time = request()->class_end_time;
        $data->save();

        return response()->json($data, 200);
    }

    public function soft_delete()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_batches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseBatches::find(request()->id);
        $data->status = 'inactive';
        $data->save();

        return response()->json([
                'result' => 'deactivated',
        ], 200);
    }

    public function destroy()
    {

        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_batches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseBatches::find(request()->id);
        $data->delete();

        return response()->json([
                'result' => 'deleted',
        ], 200);
    }

    public function restore()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required','exists:course_batches,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = CourseBatches::find(request()->id);
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
            $check = CourseBatches::where('id',$item->id)->first();
            if(!$check){
                try {
                    CourseBatches::create((array) $item);
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
