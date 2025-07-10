<?php

namespace App\Models\Course;

use App\Models\Quiz\Quiz;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleClasses extends Model 
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        static::created(function ($data) {
            $data->slug = random_int(100, 999) . $data->id . random_int(1000, 9999);
            $data->save();
        });
    }

    public function class_quiz()
    {
        return $this->hasOne(CourseModuleClassQuizes::class, 'course_module_class_id', 'id');
    }

    public function routine()
    {
        return $this->hasOne(CourseModuleClassRoutines::class, 'class_id');
    }
    
    public function resource()
    {
        return $this->hasOne(CourseModuleClassResourses::class, 'course_module_class_id');
    }

    public function module()
    {
        return $this->belongsTo(CourseModule::class, 'course_modules_id', 'id');
    }

    public function class_exam()
    {
        return $this->hasOne(CourseModuleClassExams::class, 'course_module_class_id', 'id');
    }
}
