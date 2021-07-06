<?php

namespace App\Http\Controllers;

use App\Models\PhotoModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller


{
    function photoIndex(){

        return view('gallery');
    }

    function PhotoUpload(Request $request){

        $photopath= $request->file('photo')->store('public');
        $photoName=(explode('/',$photopath))[1];

        $host=$_SERVER['HTTP_HOST'];

        $location="http://".$host."/storage/".$photoName;

       $results= PhotoModel::insert(['location'=>$location]);
        return $results;
    }

    function photoJson(){

        return PhotoModel::take(4)->get();


    }
    function photoJsonById(Request $request){
        $firstid=$request->id;
        $lastid=$firstid+4;
        return PhotoModel::where('id','>=',$firstid)->where('id','<',$lastid)->get();

    }

    function photoDelete(Request $request){

        $oldurl=$request->input('oldphotourl');
        $oldid=$request->input('id');
        $oldphotourlarray=explode("/",$oldurl);
        $oldphotoname=end($oldphotourlarray);
        $deletephotofile=Storage::delete('public/'.$oldphotoname);
        $deleterow=PhotoModel::where('id','=', $oldid)->delete();
        return $deleterow;

        
    }
}
