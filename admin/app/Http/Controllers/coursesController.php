<?php

namespace App\Http\Controllers;
use App\Models\CourseModel;

use Illuminate\Http\Request;

class coursesController extends Controller
{
    function CoursesIndex(){
        return view('courses');
    }


    function getCoursesData(){

        $results=json_encode(CourseModel::orderBy('id','desc')->get());
        return $results;

    }


    function getCoursedetails(Request $req){

       $id=$req->input('id');
       $results=json_encode(CourseModel::where('id','=',$id)->get());
       return $results;
    }


    function courseDelete(Request $request){
        $id=$request->input('id');
        $results=CourseModel::where('id','=',$id)->delete();
            if($results==true){
                return 1 ;
            }else{
                return 0;
            }
                        
   }


   function courseUpdate(Request $req){
    $id=$req->input('id');
    $course_name=$req->input('course_name');
    $course_des=$req->input('course_des');
    $course_fee=$req->input('course_fee');
    $course_totalenroll=$req->input('course_totalenroll');
    $course_totalclass=$req->input('course_totalclass');
    $course_link=$req->input('course_link');
    $course_img= $req->input('course_img');
   $results=CourseModel::where('id','=',$id)->update([
    'course_name'=>$course_name,
   'course_des'=>$course_des,
   'course_fee'=>$course_fee,
   'course_totalenroll'=>$course_totalenroll,
   'course_totalclass'=>$course_totalclass,
   'course_link'=>$course_link,
   'course_img'=>$course_img
   ]);
   if($results==true){
    return 1 ;
}else{
    return 0;
}
}



function courseAdd(Request $req){

    $course_name=$req->input('course_name');
    $course_des=$req->input('course_des');
    $course_fee=$req->input('course_fee');
    $course_totalenroll=$req->input('course_totalenroll');
    $course_totalclass=$req->input('course_totalclass');
    $course_link=$req->input('course_link');
    $course_img= $req->input('course_img');
   $results=CourseModel::insert([
    'course_name'=>$course_name,
    'course_des'=>$course_des,
    'course_fee'=>$course_fee,
    'course_totalenroll'=>$course_totalenroll,
    'course_totalclass'=>$course_totalclass,
    'course_link'=>$course_link,
    'course_img'=>$course_img      
       ]);
   if($results==true){
    return 1 ;
}else{
    return 0;
}

}






}
