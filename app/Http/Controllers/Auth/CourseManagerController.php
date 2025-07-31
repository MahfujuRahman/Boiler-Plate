<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseManagerController extends Controller
{
    public function dashboard() {
        return view('backend.course_manager.dashboard');
    }

    public function courses() {
        return view('backend.course_manager.courses');
    }

    public function quizes() {
        return view('backend.course_manager.quiz');
    }

    public function teachers() {
        return view('backend.course_manager.teacher.teacher');
    }

    // public function gallery_category() {
    //     return view('backend.course_manager.gallery.gallery_category');
    // }

    public function gallerycs() {
        return view('backend.course_manager.gallery.gallerycs');
    }

    public function gallery() {
        return view('backend.course_manager.gallery.gallery');
    }

}
