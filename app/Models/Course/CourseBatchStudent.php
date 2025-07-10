<?php

namespace App\Models\Course;

use App\Models\User;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBatchStudent extends Model
{
    use HasFactory;

    public function batch(){
        return $this->belongsTo(CourseBatches::class, 'batch_id');
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function student(){
        return $this->hasMany(User::class,'id', 'student_id');
    }
}
