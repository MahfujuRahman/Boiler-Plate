<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WebsiteCoreInformationController extends Controller
{
    public function webiste_core() {
        return view('backend.course_manager.websitecore.websitecore');
    }

    public function webiste_brand() {
        return view('backend.course_manager.websitebrand.websitebrand');
    }

    public function webiste_banner() {
        return view('backend.course_manager.websitebanner.websitebanner');
    }

}
