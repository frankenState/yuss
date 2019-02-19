<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Question;
use App\User;
use DB;
class QuestionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data = DB::table('questions')
                    ->join('users', 'users.id', '=', 'questions.user_id')
                    ->select('questions.*','users.first_name','users.last_name')
                    ->paginate(3);

        return view('question.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question_txt' => 'required',
            'question_pic' => 'image|nullable|max:1999'
      ]);  

        // Handle File Upload
       if ($request->hasFile('question_pic')){
            // Get filename with the extension
            $filenameWithExt = $request->file('question_pic')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('question_pic')->getClientOriginalExtension();
            // FIlename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('question_pic')->storeAs('public/question_pics', $fileNameToStore);
       } else {
            $fileNameToStore = 'noimage.jpg';
       }

        $user_id = auth()->user()->id;
        $q = new Question();
        $q->user_id = $user_id;
        $q->question_txt = $request->input('question_txt');
        $q->question_pic = $fileNameToStore;
        $q->save();

        return redirect('/home')->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = DB::table('questions')
                    ->join('users', 'users.id', '=', 'questions.user_id')
                    ->select('questions.*','users.first_name','users.last_name')
                    ->where('questions.id',$id)
                    ->get();

        $comments = DB::table('comments')
                    ->join('questions', 'questions.id','=','comments.question_id')
                    ->join('users','users.id','=','comments.user_id')
                    ->select('users.first_name','users.last_name','comments.created_at','comments.comment_txt', 'comments.user_id', 'comments.id')
                    ->where('comments.question_id',$id)
                    ->get();

       // return $comments;
        return view('question.show', ['comments' => $comments,
                                      'questions' => $question, 
                                      'id' => auth()->user()->id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit')->with('question',$question);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'question_txt' => 'required',
            'question_pic' => 'image|nullable|max:1999'
      ]);  

        // Handle File Upload
       if ($request->hasFile('question_pic')){
            // Get filename with the extension
            $filenameWithExt = $request->file('question_pic')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('question_pic')->getClientOriginalExtension();
            // FIlename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('question_pic')->storeAs('public/question_pics', $fileNameToStore);
       } 

        $user_id = auth()->user()->id;
        $q = Question::find($id);
        $q->user_id = $user_id;
        $q->question_txt = $request->input('question_txt');
        if ($request->hasFile('question_pic')){
            $q->question_pic = $fileNameToStore;
        }
        $q->save();

        return redirect('/home')->with('success','Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);

        // Check for correct user
        if(auth()->user()->id !== $question->user_id){
            return redirect('/home')->with('error', 'Unauthorized Delete');
        } 
        
        if ($question->cover_image != 'noimage.jpg'){
            // Delete Image
            Storage::delete('public/cover_images/'.$question->question_pic);
        }

        $question->delete();
        return redirect('/home')->with('success', 'Question Removed');
    }
}
