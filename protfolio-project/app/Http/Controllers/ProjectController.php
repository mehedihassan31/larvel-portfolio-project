<?php

namespace App\Http\Controllers;

use App\Models\ProjectsModel;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    function projectIndex(){
        $projectdata=json_decode(ProjectsModel::all());

        return view('projects',[
            'projectdata'=>$projectdata

        ]);
    }


}
