<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Chatroom;
use DB;
class GroupchatController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	// join chatroom and user, users.id=chatrooms.user_id
 	   	$data = DB::table('chatrooms')
                    ->join('users', 'users.id', '=', 'chatrooms.user_id')
                    ->select('users.first_name','users.last_name','chatrooms.message_txt', 'chatrooms.created_at')
                    ->orderBy('chatrooms.created_at','desc')
                    ->get();
    	return view('chat.index')->with('data', $data);
    }

    public function send(Request $request){
    	$this->validate($request, [
            'message_txt' => 'required',
      ]);  

    	// insert into chat room
    	$cr = new Chatroom();
    	$cr->user_id = auth()->user()->id;
    	$cr->message_txt = $request->input('message_txt');
    	$cr->save();

    	return redirect('/chatroom')->with('success','Message sent.');
    }

    public function refresh(){
    	 	$data = DB::table('chatrooms')
                    ->join('users', 'users.id', '=', 'chatrooms.user_id')
                    ->select('users.first_name','users.last_name','chatrooms.message_txt', 'chatrooms.created_at')
                    ->orderBy('chatrooms.created_at','desc')
                    ->get();
           return view('chat.refresh')->with('data',$data);
    }
}
