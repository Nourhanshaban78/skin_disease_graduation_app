<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Model_result;
use Illuminate\Support\Facades\Auth;

class DeepController extends Controller
{
    public function runModel()
{
   
    $accuracy = $this->model->run();

    DB::table('model_results')->insert([
        'user_id' => auth()->id(),
        'model_name' => 'Densenet201',
        'accuracy' => $accuracy,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return response()->json(['accuracy' => $accuracy]);
}

public function showModelResults()
{
    $results = DB::table('model_results')
        ->where('user_id', auth()->id())
        ->orderByDesc('created_at')
        ->get();

    return response()->json(['results' => $results]);
}

}
