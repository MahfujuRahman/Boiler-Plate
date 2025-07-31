<?php

namespace App\Models\Quiz;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    public function questions() {
        return $this->belongsToMany(QuizQuestion::class);
    }

    public function users() {
        return $this->belongsToMany(User::class, 'quiz_users', 'quiz_id', 'user_id');
    }

}
