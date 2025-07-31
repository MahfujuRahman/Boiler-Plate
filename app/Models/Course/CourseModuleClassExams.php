<?php

namespace App\Models\Course;

use App\Models\Exam\Exam;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleClassExams extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        static::created(function ($data) {
            $data->slug = random_int(100,999).$data->id.random_int(1000,9999);
            $data->save();
        });
        
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class, 'exam_id');
    }
}
