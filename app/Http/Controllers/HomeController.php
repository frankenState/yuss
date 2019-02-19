<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Question;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = User::find(auth()->user()->id);
        $questions = auth()->user()->question;
        return view('home', ['user' => auth()->user(), 'questions' => $questions]); 
    }
    public function update(){
        $user = User::find(auth()->user()->id);
        return view('pages.update_user')->with('user', $user);
    }
    public function edit(Request $request){
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'new_password' => 'required',
            'profile_picture' => 'image|nullable|max:1999'
      ]);  

        // Handle File Upload
       if ($request->hasFile('profile_picture')){
            // Get filename with the extension
            $filenameWithExt = $request->file('profile_picture')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just extension
            $extension = $request->file('profile_picture')->getClientOriginalExtension();
            // FIlename to store
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            // Upload image
            $path = $request->file('profile_picture')->storeAs('public/profile_pictures', $fileNameToStore);
       } 


        // update the user
        $user = User::find(auth()->user()->id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('new_password'));
        if ($request->hasFile('profile_picture')){
          $user->profile_picture = $fileNameToStore;
        }
        $user->save();

        return redirect('/home')->with('success', 'Successffully Updated');
    }
}
