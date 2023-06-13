<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Image;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Scan;
use App\Models\User;


class PhotoController extends Controller
{
    public function store (Request $request){

    
        $photo=new Photo;
        $photo->name=$request->file('image')->getClientOriginalName();
        $photo->path= $request->file('image')->store('public/images');
        $photo->save();
        return $photo;
    }


    

    public function get_photos($id){
        // $photo= Photo::whereId(Auth::id())->get();
        $photo= Photo::find($id);
        return $photo;
    }


    public function store_photos_all(Request $request){
        $photo = new Scan;
        $photo->name=$request->file('image')->getClientOriginalName();
        $photo->path= $request->file('image')->store('public/scan');
        $photo->user_id=Auth::user()->id;
       // $photo->user_id=user::find($id);
        //$photo->user_id= User::whereId(Auth::id());
        
        $photo->save();
        return $photo;



    }

    
    

}
