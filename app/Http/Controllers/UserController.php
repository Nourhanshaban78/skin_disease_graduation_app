<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\PasswordReset;
use Auth;
use Validator;
use Str;
use URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function register(Request $request){
        $validator =Validator::make($request->all(),[
            'fristname'=>'required|string|min:2|max:255',
            'lastname'=>'required|string|min:2|max:255',
            'gender'=>'required|string|min:2|max:255',
            'type'=>'required|string|min:2|max:255',
            'username'=>'required|string|min:2|max:255|unique:users',
            'email'=>'required|string|email|min:2|max:255|unique:users',
            'password'=>'required|string|min:6|max:255|confirmed',
            
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),401);

        }

        $user=User::create([

            'fristname'=>$request->fristname,
            'lastname'=>$request->lastname,
            'gender'=>$request->gender,
            'type'=>$request->type,
            'username'=>$request->username,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'status' =>'In Progress',


        ]);
        return response()->json([
            'message'=>'User registered successfully',
            'user'=>$user,
            

        ],200);
       

    }



    public function login(Request $request){

        $validator =Validator::make($request->all(),[
            'email'=>'required|string|email',
            'username'=>'required|string',
            'password'=>'required|string|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),400);

        }

        if(! $token = auth()->attempt($validator->validated())){
            return response()->json(['error'=>'Unauthorized'],401);

        }
      return $this->createWithToken($token);

    }


    protected function createWithToken($token){
        return response()->json([

            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'type'=>User::whereId(Auth::id())->pluck('type'),
            'status'=>Doctor::whereId(Auth::id())->pluck('boolean'),
            
       
        
            

        ]);
        
    }
    public function profile(){
        return response()->json(auth()->user());
    }
    public function refresh(){
        return $this->createWithToken(auth()->refresh());

    }
    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out']);
    }

    public function update_profile(Request $request){
        if(auth()->user())
        {
           $validator=Validator::make($request->all(),[
               
           'id' => 'required',
            //'fristname'=>'required|min:2|max:255',
            //'lastname'=>'required|min:2|max:255',
            'username'=>'required|min:2|max:255',
           

           ]);
           if($validator->fails())
           {
              return response()->json($validator->errors());

           }

             $user=User::find($request->id);
            // $user->fristname=$request->fristname;
            // $user->lastname=$request->lastname;
            $user->username=$request->username;
            $user->save();
            return response()->json(['status'=>'true','msg'=>'User data is updated','data'=>$user]);
        }
        
        else{
            return response()->json(['status'=>'false','msg'=>'user is not authentication']);

        }
    }

        public function deleteaccount($id)
          {
           $user=User::find($id);
           $user->delete();
        return response()->json(['status'=>'true','msg'=>'Account Deleted']);
    }

    
         public function admin(){
           $data=User::all();
          return $data;
}



public function forget_password(Request $request){
   try{
      $user = User::where('email',$request->email)->get();

      if(count($user) > 0){
        $token = Str::random(40);
        $domain =  URL::to('/');
        $url = $domain.'/reset_password?token='.$token;

        $data['url']=$url;
        $data['email']=$request->email;
        $data['title']= 'Password Reset';
        $data['body'] = 'please click on below link to reset your password';
        Mail::send('forgetPasswordMail',['data'=>$data],function($message) use ($data){
                 $message->to($data['email'])->sunject($data['title']);
        });
         $datetime = carbon::now()->format('Y-m-d H:i:s ');
         PasswordReset::updateOrCreate(
            ['email'=>$request->email],
            [
                'email' =>$request->email,
                'token' =>$token,
                'created_at' => $datetime

            ]
         );

             return response()->json(['status'=>'true','msg'=>'Please check your mail to reset your password']);


      }
      else{
        return response()->json(['status'=>'false','msg'=>'User not found']);
      }

    }catch(\Exception $e){
        return response()->json(['status'=>'false','msg'=>$e->getMessage()]);
}

}

// public function doctors(Request $request){
//     $user = Auth::user();
// if ($user->type === 'doctor') {
//     $user=new Doctor;
//     $user->address=$request->address;
//     $user->phone=$request->phone;
//     $user->degree=$request->degree;
//     $user->status='In progress';
//     if(Auth::user()->type=='doctor'){
//         $user->boolean='true';
//         }
//         else {
//             $user->boolean='false';
//         }
//     if(Auth::id()){
//     $user->user_id=Auth::user()->id;
//     }
//     $pdf=$request->pdf;
//     $imagename=time().'.'.$pdf->getClientOriginalName();
//     $request->pdf->move('doctorimage', $imagename);
//     $user->pdf=$imagename;
//     $user->save();
//     return response()->json(['status'=>'true','msg'=>'Doctor added successfully','data'=>$user]); 
// }
// else {
//     return response()->json(['status'=>'true','msg'=>'paitent register successfully']);
// }
    
// }


public function doctors(Request $request){
    $user = Auth::user();
    $user=new Doctor;
    $user->address=$request->address;
    $user->phone=$request->phone;
    $user->degree=$request->degree;
    $user->status='In progress';
    if(Auth::user()->type=='doctor'){
        $user->boolean='true';
        }
        else {
            $user->boolean='false';
        }
    if(Auth::id()){
    $user->user_id=Auth::user()->id;
    }
    $pdf=$request->pdf;
    $imagename=time().'.'.$pdf->getClientOriginalName();
    $request->pdf->move('doctorimage', $imagename);
    $user->pdf=$imagename;
    $user->save();

    return $user;
}






    
        
        
        
        
        
        







}
