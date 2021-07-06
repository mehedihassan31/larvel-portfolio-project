<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    function courseIndex(){
        $coursesdata=json_decode(CourseModel::all());
        return view('course',[
            'coursesdata'=>$coursesdata
        ]);
    }
}
