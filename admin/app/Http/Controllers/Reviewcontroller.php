<?php

namespace App\Http\Controllers;

use App\Models\ReviewModel;
use Illuminate\Http\Request;

class Reviewcontroller extends Controller
{
    function reviewsIndex(){

        return view('review');
    }

    function getreviewsData(){
        $results=json_encode(ReviewModel::orderBy('id','desc')->get());
        return $results;
    }

    function reviewDelete(Request $req){
        $id=$req->input('id');
        $results=ReviewModel::where('id','=',$id)->delete();
        if($results==true){
            return 1;
        }else{
            return 0;
        }
    }

    function reviewAdd(Request $req){
        $name=$req->input('name');
        $des=$req->input('des');
        $img= $req->input('img');
        $results=ReviewModel::insert([
            'name'=>$name,
            'des'=>$des,
            'img'=>$img   
        ]);
        if($results==true){
            return 1 ;
        }else{
            return 0;
        }
    }



    function reviewUpdate(Request $req){
        $id=$req->input('id');
        $name=$req->input('name');
        $des=$req->input('des');
        $img= $req->input('img');
        $results=ReviewModel::where('id','=',$id)->update([
            'name'=>$name,
            'des'=>$des,
            'img'=>$img    
           ]);
           if($results==true){
            return 1 ;
        }else{
            return 0;
        }

    }


    function getreviewdetails(Request $req){

        $id=$req->input('id');
        $results=json_encode(ReviewModel::where('id','=',$id)->get());
        return $results;
     }
}
