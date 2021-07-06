<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\CourseModel;
use App\Models\ProjectsModel;
use App\Models\ReviewModel;
use App\Models\ServicesModel;
use App\Models\VisitorModel;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomeIndex(){

       $totalcontact =ContactModel::count();
       $totalcourse=CourseModel::count();
       $totalproject=ProjectsModel::count();
       $totalreview=ReviewModel::count();
       $totalservice=ServicesModel::count();
       $totalvisitor=VisitorModel::count();
        return view('home',[
            'totalcontact'=>$totalcontact,
            'totalcourse'=>$totalcourse,
            'totalproject'=>$totalproject,
            'totalreview'=>$totalreview,
            'totalservice'=>$totalservice,
            'totalvisitor'=>$totalvisitor
        ]);

    }
}
