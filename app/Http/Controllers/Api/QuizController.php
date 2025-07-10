<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Quiz;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class QuizController extends Controller
{
    public function all()
    {
        $paginate = (int) request()->paginate ?? 10;
        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';

        $query = Quiz::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('title', 'LIKE', '%' . $key . '%');
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
        $data = Quiz::where('id', $id)
            ->select($select)
            ->with(['questions'])
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
        // dd(request()->all());
        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $question_ids = json_decode(request()->question_ids);
        $data = new Quiz();
        $data->title = request()->title;
        $data->save();


        foreach ($question_ids as $key => $question_id) {
            $quiz_question = QuizQuestion::where('id', $question_id)->first();
            // dd($quiz_question);
            $quiz_question->quiz_id = $data->id;
            $quiz_question->save();
        }

        return response()->json(["data" => $data, "message" => 'Quiz created successfully!'], 200);
    }

    public function update()
    {
        $data = Quiz::find(request()->id);
        if (!$data) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => ['name' => ['data not found by given id ' . (request()->id ? request()->id : 'null')]],
            ], 422);
        }

        $validator = Validator::make(request()->all(), [
            'title' => ['required'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $question_ids = json_decode(request()->question_ids);
        $data->title = request()->title;
        $data->save();
        DB::table('quiz_quiz_question')->whereNotIn('quiz_question_id', $question_ids)->delete();
        foreach ($question_ids as $key => $question_id) {
            $question_check = DB::table('quiz_quiz_question')->where('quiz_question_id', $question_id)->first();
            if(!$question_check) {
                DB::table('quiz_quiz_question')->insert([
                    'quiz_id' => $data->id,
                    'quiz_question_id' => $question_id
                ]);
            }

        }

        return response()->json(["data" => $data, "message" => 'Quiz Updated successfully!'], 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:quizes,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = Quiz::find(request()->id);
        $data->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }
}
