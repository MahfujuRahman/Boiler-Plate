<?php

namespace App\Models\Course;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBatches extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $appends = [
        'left_days',
    ]; 
    public function scopeActive($q)
    {
        return $q->where('status', 'active');
    }

    public function course() {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function getLeftDaysAttribute()
    {
        $toDate = Carbon::parse($this->admission_end_date);
        $fromDate = Carbon::now();
        $leftDays = $toDate->diffInDays($fromDate);
        return $leftDays;
    }

    public function course_instructors() {
        return $this->belongsToMany(CourseInstructors::class, 'course_course_instructor', 'batch_id', 'instructor_id', 'id');
    }


}
