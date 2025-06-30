<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModule extends Model
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

    public function classes()
    {
        return $this->hasMany(CourseModuleClasses::class,'course_modules_id');
    }

    public function course()
    {
        return $this->hasOne(Course::class, 'id');
    }

    public function quizes()
    {
        return $this->hasMany(CourseModuleClassQuizes::class,'course_module_id');
    }
}
