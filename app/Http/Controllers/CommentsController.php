<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $id){
    	$this->validate($request, [
            'comment_txt' => 'required',
      ]);  

    	$comment = new Comment();
    	$comment->question_id = $id;
    	$comment->user_id = auth()->user()->id;
    	$comment->comment_txt = $request->input('comment_txt');
    	$comment->save();

    	return redirect('/question/'.$id)->with('success','Comment Sent');
    }

    public function delete($q_id, $id){
        $cmnt = Comment::find($id);
        $cmnt->delete();

        return redirect('/question/'.$q_id)->with('success','Deleted Successfully');
    }
}
