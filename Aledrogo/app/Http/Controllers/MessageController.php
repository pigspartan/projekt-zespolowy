<?php

namespace App\Http\Controllers;
use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
{

    $message = new Message;
    $message->sender_id = auth()->user()->id; //nwm czemu płacze ale przechodzi nolmalnie
    $message->recipient_id = $request->recipient_id;
    $message->message = $request->message;
    $message->save();
    return redirect()->route('index');

}

}
