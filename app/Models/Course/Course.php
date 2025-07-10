<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected static function booted()
    {
        static::created(function ($data) {
            $random_no = random_int(100, 999) . $data->id . random_int(100, 999);
            $slug = $data->title . " " . $random_no;
            $data->slug = Str::slug($slug);
            $data->save();
        });
    }

    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function course_batch()
    {
        return $this->hasMany(CourseBatches::class, 'course_id', 'id');
    }

    public function milestones()
    {
        return $this->hasMany(CourseMilestone::class, 'course_id');
    }

    public function course_mile_stones()
    {
        return $this->hasMany(CourseMilestone::class, 'course_id');
    }

    public function class_routines()
    {
        return $this->hasMany(CourseModuleClassRoutines::class, 'course_id');
    }

    public function course_job_works()
    {
        return $this->hasMany(CourseJobWorks::class, 'course_id');
    }

    public function course_modules()
    {
        return $this->hasMany(CourseModule::class, 'course_id');
    }

    public function course_module_task_complite_by_user()
    {
        return $this->hasMany(CourseModuleTaskCompleteByUsers::class, 'course_id');
    }

    public function course_instructor()
    {
        return $this->hasMany(CourseInstructors::class, 'course_id');
    }

    public function course_instructors()
    {
        return $this->belongsToMany(CourseInstructors::class, 'course_course_instructor', 'course_id', 'instructor_id');
    }

    public function course_job_position()
    {
        return $this->hasMany(CourseJobPositions::class, 'course_id');
    }

    public function course_module_at_a_glance()
    {
        return $this->hasMany(CourseModuleAtAGlances::class, 'course_id');
    }

    public function course_what_you_will_get()
    {
        return $this->hasMany(CourseWhatYouWillGets::class, 'course_id');
    }


    public function course_for_whomes()
    {
        return $this->hasMany(CourseForWhoms::class, 'course_id');
    }

    public function course_faqs()
    {
        return $this->hasMany(CourseFaqs::class, 'course_id');
    }

    public function course_essentials()
    {
        return $this->hasMany(CourseEssentialRequirements::class, 'course_id');
    }


    public function course_essential_requirements()
    {
        return $this->hasMany(CourseEssentialRequirements::class, 'course_id');
    }

    public function course_you_will_learns()
    {
        return $this->hasMany(CourseYouWillLearns::class, 'course_id');
    } 

    public function course_you_will_learn_for_us()
    {
        return $this->hasMany(CourseWhyYouLearnFromUs::class, 'course_id');
    }

    public function course_batches()
    {
        return $this->hasMany(CourseBatches::class, 'course_id');
    }
}
