<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Talk;
use App\Models\Chat;


class TalkController extends Controller
{
    public function index($sender_id, $receiver_id)
    {
        $talks = Talk::where('sender_id', $sender_id)->where('receiver_id', $receiver_id)
        ->orWhere('sender_id', $receiver_id)->orWhere('receiver_id', $sender_id)
        ->orderBy('created_at', 'asc')->get();
        return response()->json([
            'talks' => $talks
        ]);
    }

    public function store(Request $request)
    {
        $talk = new Talk;
        $talk->sender_id = $request->sender_id;
        $talk->receiver_id = $request->receiver_id;
        $talk->chat = $request->chat;
        $talk->save();
        return response()->json([
            'chat' => 'Message sent!'
        ]);
    }

    public function destroy(Talk $talk)
    {
        $talk->delete();
        return response()->json(null, 204);
    }




    

}
