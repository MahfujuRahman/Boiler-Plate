<?php

namespace App\Models\Course;

use App\Models\User;
use App\Models\User\UserSocialLinks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseInstructors extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected static function booted()
    {
        static::created(function ($data) {
            $data->slug = random_int(10,99).$data->id.random_int(100,999);
            $data->save();
        });
    }
    
    public function user()
    {
        return $this->hasOne(User::class, 'user_id');
    }

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function social_links()
    {
        return $this->hasMany(UserSocialLinks::class, 'user_id');
    }

    public function courses() {
        return $this->belongsToMany(Course::class, 'course_course_instructor', 'instructor_id', 'course_id', 'id');
    }
    public function batches() {
        return $this->belongsToMany(CourseBatches::class, 'course_course_instructor', 'instructor_id', 'batch_id', 'id');
    }

    // public social_media
}
