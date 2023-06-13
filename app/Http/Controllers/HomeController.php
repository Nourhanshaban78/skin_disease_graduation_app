<?php

namespace App\Http\Controllers;
use App\Models\Photo;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $photos=Photo::all();
        
        return view('home');
    }
    public function store(Request $request)
    {
    

       $name=$request->file('image')->getClientOriginalName();
       $path=$request->file('image')->store('public/images');
       $photo=new Photo();
       $photo->name=$name;
       $photo->path=$path;
       $photo->save();
       return redirect()->back();


    }

    








}
