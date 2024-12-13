<?php

namespace App\Http\Controllers;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
{

    $message = new Message;
    $message->sender_id = auth()->user()->id; //nwm czemu płacze ale przechodzi nolmalnie
    $recid = User::where('email', $request->recipient_mail)->first();
    #dd($request);
    $message->recipient_id = $recid->id;
    $message->message = $request->message;
    $message->save();
    return redirect()->route('message');

}
public function showMessages()
{
    $messages = auth()->user()->receivedMessages()->latest()->get();
    #dd($messages);
    return view('message.mess', compact('messages'));
}
}
