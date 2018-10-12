<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
class HomeController extends Controller
{

    protected $redirectTo = '/home';
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
        //User::all();
        $users = DB::table('users')->where([
            ['lat', '>', '34'],
            ['lat', '<', '41'],
        ])->get();
        return view('home.index',compact('users'));
    }

    //move to another controller eventually
    //change so it sends a request and not just adding friends
    public function sendFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->insert(
            ['user_id' => $user_id, 'friend_id' => $id]
        );
        return redirect()->intended("/home");
    }
}
