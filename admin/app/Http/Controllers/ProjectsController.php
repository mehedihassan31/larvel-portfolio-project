<?php

namespace App\Http\Controllers;

use App\Models\ProjectsModel;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class ProjectsController extends Controller
{
    function ProjectsIndex(){

        return view('Projects');
    }

    function getProjectsData(){
        $results=json_encode(ProjectsModel::orderBy('id','desc')->get());
        return $results;
    }

    function ProjectDelete(Request $req){
        $id=$req->input('id');
        $results=ProjectsModel::where('id','=',$id)->delete();
        if($results==true){
            return 1;
        }else{
            return 0;
        }
    }

    function ProjectAdd(Request $req){
        $project_name=$req->input('project_name');
        $project_des=$req->input('project_des');
        $project_link=$req->input('project_link');
        $project_img= $req->input('project_img');
        $results=ProjectsModel::insert([
            'project_name'=>$project_name,
            'project_des'=>$project_des,
            'project_link'=>$project_link,
            'project_img'=>$project_img   
        ]);
        if($results==true){
            return 1 ;
        }else{
            return 0;
        }
    }



    function ProjectUpdate(Request $req){

        $id=$req->input('id');
        $project_name=$req->input('project_name');
        $project_des=$req->input('project_des');
        $project_link=$req->input('project_link');
        $project_img= $req->input('project_img');
        
        $results=ProjectsModel::where('id','=',$id)->update([
            'project_name'=>$project_name,
            'project_des'=>$project_des,
            'project_link'=>$project_link,
            'project_img'=>$project_img  
           ]);
           if($results==true){
            return 1 ;
        }else{
            return 0;
        }

    }


    function getProjectdetails(Request $req){

        $id=$req->input('id');
        $results=json_encode(ProjectsModel::where('id','=',$id)->get());
        return $results;
     }


}
