<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Searches;


class AdminController extends Controller
{
    public function users(){
        $user=User::all();
        return $user;
    }

    public function approved($id){
        $data = User::find($id);
        $data->status='approved';
        $data->save();
        return $data;
    }
    public function canceled($id){
        $data = User::find($id);
        $data->status='canceled';
        $data->save();
        return $data;
    }
 public function all_doctors(){
    $doc=Doctor::all();
    return $doc;
 }
 public function approved_doctor($id){
    $data = Doctor::find($id);
    $data->status='approved';
    $data->save();
    return  response()->json(['status'=>true,'data'=>$data]);
}
public function canceled_doctor($id){
    $data = Doctor::find($id);
    $data->status='canceled';
    $data->save();
    return response()->json(['status'=>true,'data'=>$data]);
}
 
public function deleted_doctor($id){
    $data = Doctor::find($id);
    $data->delete();
 return response()->json(['status'=>'true', 'msg' =>'Doctors is delete']);
}

public function add_search(Request $request){
    $data = new Searches;
    $data->name=$request->name;
    $data->paraphrase=$request->paraphrase;
    $data->discribe=$request->discribe;
    $data->save();
    return response()->json(['status'=>'true','msg'=>'Added Searches Successfully' ,'data'=>$data]);
}


public function deleted_search($id){
    $data = Searches::find($id);
    $data->delete();
 return response()->json(['status'=>'true', 'msg' =>'Searches is Delete']);
}

public function update_search($id){
    $data=Searches::find($id);
    return $data;

 }

 public function edit_search(Request $request,$id){
    $data = Searches::find($id);
    $data->name=$request->name;
    $data->paraphrase=$request->paraphrase;
    $data->discribe=$request->discribe;
    $data->save();
    return response()->json(['status'=>'true','msg'=>' Searches edit Successfully' ,'data'=>$data]);
 }












}


