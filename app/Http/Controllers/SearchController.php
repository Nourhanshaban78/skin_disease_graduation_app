<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Searches;

class SearchController extends Controller
{
    public function search($name){
        
         return Searches::where('name',$name)->get();
    }



   

    



}
