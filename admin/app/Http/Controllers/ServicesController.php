<?php

namespace App\Http\Controllers;

use App\Models\ServicesModel;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    function ServicesIndex(){


        return view('Services');
    }

    function getServicesData(){

        $results=json_encode(ServicesModel::orderBy('id','desc')->get());
        return $results;

    }




    function serviceDelete(Request $request){
        $id=$request->input('id');
        $results=ServicesModel::where('id','=',$id)->delete();



            if($results==true){

                return 1 ;
            }else{

                return 0;
            }


                        
   }

function getdetails(Request $req){

    $id=$req->input('id');
   $results=json_encode(ServicesModel::where('id','=',$id)->get());

   return $results;




}
function serviceUpdate(Request $req){

    $id=$req->input('id');
    $name=$req->input('name');
    $des=$req->input('des');
    $img=$req->input('img');
   $results=ServicesModel::where('id','=',$id)->update(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);

  
   if($results==true){

    return 1 ;
}else{

    return 0;
}
}


function serviceAdd(Request $req){


    $name=$req->input('name');
    $des=$req->input('des');
    $img=$req->input('img');
   $results=ServicesModel::insert(['service_name'=>$name,'service_des'=>$des,'service_img'=>$img]);
   if($results==true){
    return 1 ;
}else{

    return 0;
}

}
 



}
