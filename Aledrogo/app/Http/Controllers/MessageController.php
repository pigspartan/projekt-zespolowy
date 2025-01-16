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
    $recid = User::where('id', $request->rec_id)->first();
    //dd($request);

    $message->recipient_id = $recid->id;
    $message->message = $request->message;
    if($request->message==Null)
        {
            return redirect()->route('index');
        }
    $message->save();
    return redirect()->route('message');

}
public function sshowMessages()
{
    $messages = auth()->user()->receivedMessages()->latest()->get();
    dd($messages);
    return view('message.mess', compact('messages'));
}
public function showMessages()
{
    $temp = auth()->user()->receivedMessages()->get();
    $temp2= auth()->user()->sentMessages()->get();
    $usersid = array();
    foreach($temp as $value){
        array_push($usersid,$value->sender_id);
    }
    foreach($temp2 as $value){
        array_push($usersid,$value->recipient_id);
    }
    $usersid=array_unique($usersid);
    $usersout = array();
    $msg=array();
    foreach($usersid as $value){
        array_push($usersout,  User::find($value));
    }
    //dd($usersout);
    $cid=array();
    return view('message.mess', ['usersout' => $usersout, 'msg' => $msg,'cid'=>$cid]);
}


public function chosenchat(Request $request){
//dd(Message::where('recipient_id',auth()->user()->id)->Where('sender_id', $request->sender)->get());
$msg=Message::where('recipient_id',auth()->user()->id)->Where('sender_id', $request->sender)->get();
$cid=$request->sender;
//dd($cid);
//dd($msg);
$temp = auth()->user()->receivedMessages()->get();
$usersid = array();
foreach($temp as $value){
    array_push($usersid,$value->sender_id);
}
$usersid=array_unique($usersid);
$usersout = array();
foreach($usersid as $value){
    array_push($usersout,  User::find($value));
}
return view('message.mess', ['usersout' => $usersout, 'msg' => $msg,'cid'=>$cid]);
}
}
