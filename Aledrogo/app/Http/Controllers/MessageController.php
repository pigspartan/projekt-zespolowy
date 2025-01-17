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

    $message->recipient_id = $recid->id;
    $message->message = $request->message;
    if($request->message==Null)
        {
            return redirect()->route('index');
        }
    $message->save();
    $cid=$request->rec_id;
    $usersout=$this->sm();
    $msg=$this->chatchose($request);
    return view('message.mess', ['usersout' => $usersout, 'msg' => $msg,'cid'=>$cid]);

}
public function sm()
{
    $temp = auth()->user()->receivedMessages()->get();
    $temp2= auth()->user()->sentMessages()->get();
    $usersid = array();
    foreach($temp as $value){
        array_push($usersid,$value->rec_id);
    }
    foreach($temp2 as $value){
        array_push($usersid,$value->recipient_id);
    }
    $usersid=array_unique($usersid);
    array_shift($usersid);
    $usersout = array();

    foreach($usersid as $value){
        array_push($usersout,  User::find($value));
    }

    return $usersout;

}
public function showMessages()
{$usersout=$this->sm();
    $msg=array();
    $cid=array();
    return view('message.mess', ['usersout' => $usersout, 'msg' => $msg,'cid'=>$cid]);
}
public function chatchose(Request $request){
    $msg=Message::where('recipient_id',$request->rec_id)->Where('sender_id',auth()->user()->id)->get();
    $msg1=Message::where('sender_id',$request->rec_id)->Where('recipient_id',auth()->user()->id)->get();
    $msg=$msg->merge($msg1);
    $msg->sortBy('created_at');
    //dd($msg);
    return $msg;
}

public function chosenchat(Request $request){
$msg=$this->chatchose($request);
$usersout=$this->sm();
$cid=$request->rec_id;
//dd($cid);
return view('message.mess', ['usersout' => $usersout, 'msg' => $msg,'cid'=>$cid]);
}
}
