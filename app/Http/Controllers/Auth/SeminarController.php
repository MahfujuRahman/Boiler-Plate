<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class SeminarController extends Controller
{
    public function seminar() {
        return view('backend.course_manager.seminar.seminar');
    }
}
