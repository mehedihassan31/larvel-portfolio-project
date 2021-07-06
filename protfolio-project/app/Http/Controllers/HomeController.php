<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use App\Models\ServicesModel;
use App\Models\VisitorModel;
use Illuminate\Http\Request;
use App\Models\CourseModel;
use App\Models\ProjectsModel;
use App\Models\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){

        $user_ip=$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");

        $timeDate= date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$user_ip,'visit_time'=>$timeDate]);
      
      $servicedata= json_decode(ServicesModel::all());
      $coursesdata=json_decode(CourseModel::orderBy('id','desc')->limit(6)->get());

      $projectData= json_decode(ProjectsModel::orderBy('id','desc')->limit(10)->get());

      $reviewData= json_decode(ReviewModel::orderBy('id','desc')->limit(10)->get());



        return view('Home',[
          'servicesdata'=>$servicedata,
          'coursesdata'=>$coursesdata,
          'projectdata'=>$projectData,
          'reviewData'=>$reviewData
          
          
          ]);
    }

    function contactSend(Request $req){
      $contact_name=$req->input('contact_name');
      $contact_mobile=$req->input('contact_mobile');
      $contact_email=$req->input('contact_email');
      $contact_msg=$req->input('contact_msg');

      $results=ContactModel::insert([
        'contact_name'=>$contact_name,
        'contact_mobile'=>$contact_mobile,
        'contact_email'=>$contact_email,
        'contact_msg'=>$contact_msg
      ]);

      if($results==true){
        return 1;
      }else{

        return 0;
      }

    }



}
