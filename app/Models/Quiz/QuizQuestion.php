<?php

namespace App\Models\Quiz;

use App\Models\QuizQuestionTopic;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    use HasFactory;

    public function topic() {
        return $this->belongsTo(QuizQuestionTopic::class, 'quiz_question_topic_id');
    }

    public function options() {
        return $this->hasMany(QuizQuestionOption::class,'question_id');
    }

    public function quiz() {
        return $this->belongsToMany(Quiz::class);
    }


}
