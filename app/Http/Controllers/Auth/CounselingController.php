<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CounselingController extends Controller
{
    public function career_counseling() {
        return view('backend.course_manager.counseling.counseling');
    }
}
