<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz\QuizQuestion;
use App\Models\Quiz\QuizQuestionOption;
use App\Models\QuizQuestionTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuizQuestionController extends Controller
{
    public function all()
    {
        // dd(request()->all());
        if(request()->has('paginate')) {
            $paginate = (int) request()->paginate;
        }else {
            $paginate = 10;
        }

        $orderBy = request()->orderBy ?? 'id';
        $orderByType = request()->orderByType ?? 'ASC';
        $query = QuizQuestion::orderBy($orderBy, $orderByType);

        if (request()->has('search_key')) {
            $key = request()->search_key;
            $query->where(function ($q) use ($key) {
                return $q->where('id', '%' . $key . '%')
                    ->orWhere('title', 'LIKE', '%' . $key . '%')
                    ->orWhere('topic_title', 'LIKE', '%' . $key . '%');
            });
        }

        if(request()->has('topicID')) {
            $topic_id = (int) request()->topicID;
            $query->where('quiz_question_topic_id', $topic_id);
        }

        $datas = $query->with(['options'])->paginate($paginate);
        return response()->json($datas);
    }

    public function all_data()
    {
        $quiz_data = QuizQuestion::select('*')->with(['options'])->get();

        return response()->json($quiz_data);
    }

    public function show($id)
    {

        $select = ["*"];
        if (request()->has('select_all') && request()->select_all) {
            $select = "*";
        }
        $data = QuizQuestion::where('id', $id)
            ->select($select)->with(['options'])
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
            'topic_id' => ['required'],
        ]);
        $questions = json_decode(request()->question);
        $topic = QuizQuestionTopic::where('id', request()->topic_id)->first();

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        // for update
        if(is_array($questions)) {
            foreach ($questions as $key => $item) {

                $new_question = new QuizQuestion();
                $new_question->quiz_question_topic_id = request()->topic_id;
                $new_question->title = $item->title;
                $new_question->topic_title = $topic->title;
                $new_question->mark = $item->mark;
                $new_question->is_multiple = $item->is_multiple;
                $new_question->save();

                if(count($item->options) > 0) {
                    foreach($item->options as $option) {
                        $quiz_option = new QuizQuestionOption();
                        $quiz_option->question_id = $new_question->id;
                        $quiz_option->title = $option->title;
                        $quiz_option->is_correct = $option->is_correct;
                        $quiz_option->save();
                    }
                }

            }
            return response()->json(['message' => 'new question created successfully']);
        }else {
            $question = QuizQuestion::where('title', $questions->title)->first();

            if($question != null) {
                $question->quiz_question_topic_id = request()->topic_id;
                $question->title = $questions->title;
                $question->topic_title = $topic->title;
                $question->mark = $questions->mark;
                $question->is_multiple = $questions->is_multiple;
                $question->save();

                QuizQuestionOption::where('question_id', $questions->id)->delete();
                foreach($questions->options as $option) {
                    $quiz_option = new QuizQuestionOption();
                    $quiz_option->question_id = $question->id;
                    $quiz_option->title = $option->title;
                    $quiz_option->is_correct = $option->is_correct;
                    $quiz_option->save();
                }
                return response()->json(['message' => 'question updated successfully']);
            }
        }

        return response()->json($topic, 200);
    }

    public function update()
    {
        $data = QuizQuestion::find(request()->id);
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


        $data->title = request()->title;
        $data->description = request()->description;

        $data->save();

        return response()->json($data, 200);
    }

    public function destroy()
    {
        $validator = Validator::make(request()->all(), [
            'id' => ['required', 'exists:quiz_questions,id'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'err_message' => 'validation error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $data = QuizQuestion::find(request()->id);
        $data->delete();

        return response()->json([
            'result' => 'deleted',
        ], 200);
    }
}
