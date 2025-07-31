<?php

namespace App\Models\Course;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseModuleClassRoutines extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
       'date' => "date"  
    ];
    protected $appends = [
        "show_date"
    ];
    protected static function booted()
    {
        static::created(function ($data) {
            $data->slug = random_int(100,999).$data->id.random_int(1000,9999);
            $data->save();
        });
    }

    public function getShowDateAttribute()
    {
        return Carbon::parse($this->date)->toDateString();
    }

    public function class()
    {
        return $this->belongsTo(CourseModuleClasses::class,'class_id');
    }
}
