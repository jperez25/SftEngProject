<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
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

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->getId());

                $this->validate($request, [
            'name' => 'required',
            'bio' => 'required',
            'child_bio' => 'required',
            'parent_age' => 'required',
            'city' => 'required',
            'state' => 'required',
            'child_age' => 'required',
        ]);

        $input = $request->all();

        $user->fill($input)->save();
        return view('profile.index');

    }
}
