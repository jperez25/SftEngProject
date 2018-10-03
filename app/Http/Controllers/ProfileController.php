<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use DB;

class ProfileController extends Controller
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
        return view('profile.index');
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit')->with('user',$user);
    }

    public function update($id, Request $request)
    {                
        $user = User::find(Auth::user()->getId());          

        $request->validate([
                'name' => 'required',
                'bio' => 'required',
                'child_bio' => 'required',
                'parent_age' => 'required',
                'city' => 'required',
                'state' => 'required',
                'child_age' => 'required',
                
        ]);
        $img_path = $request->file('image');
        $img_data = file_get_contents($img_path);
        $type = pathinfo($img_path, PATHINFO_EXTENSION);
        $base64 = $base64_encode($img_data);
        $userPicture = $base64;
        $userPictureType = $type;

        $name = $request->input('name');
        $bio = $request->input('bio');
        $child_bio = $request->input('child_bio');
        $parent_age = $request->input('parent_age');
        $city = $request->input('city');
        $state = $request->input('bio');
        $child_age = $request->input('child_age');        
        //$level = 1;        
        
        
        DB::table('users')->where('id', $id)->update(
            [
                'userPicture' => $userPicture,
                'userPictureType' => $userPictureType,
                'name' => $name,
                'bio' => $bio,
                'child_bio' => $child_bio,
                'parent_age' => $parent_age,
                'city' => $city,
                'state' => $state,
                'child_age' => $child_age,
            ]
        ); 
       return redirect('/profile');

    }

    public function show()
    {
        return view('profile.index');
    }
}
