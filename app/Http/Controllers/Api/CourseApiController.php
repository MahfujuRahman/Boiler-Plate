<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class CourseApiController extends Controller
{
    public function currentCourse() {
        $user = User::find(auth()->user()->id);
        $userWithCourses = $user->load([
            'batchStudents' => function ($query) {
                $query->select('course_id', 'id', 'batch_id', 'student_id', 'course_percent', 'is_complete');
            },
            'batchStudents.course' => function ($query) {
                $query->select('id', 'title', 'image', 'slug');
            },
        ]);

        // Use collection methods to split courses based on 'is_complete'
        $completedCourses = $userWithCourses->batchStudents->where('is_complete', 'complete');
        $incompleteCourses = $userWithCourses->batchStudents->where('is_complete', 'incomplete');
        // dump($userWithCourses->batchStudents);

        $responseData = [
            'user' => $user,
            'completed_courses' => $completedCourses,
            'incomplete_courses' => $incompleteCourses,
        ];

        return response()->json($responseData, 200);
    }
}
