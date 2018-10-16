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

        if(is_null(Auth::user()->lat)){
           return redirect()->intended("/profile/edit");
        }
        
        $lat = Auth::user()->lat;
        $lng = Auth::user()->lng;
        $radius = 25;
        $users = DB::select(DB::raw("SELECT*,
        ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
        FROM `users` AS u
        where u.lng AND u.lat
        HAVING distance <= {$radius}
        ORDER BY distance ASC"));       
                
        return view('home.index',compact('users'));
    }
    public function search(Request $request)
    {
        $radius = (int)$request->input('radius');
        $lat = Auth::user()->lat;
        $lng = Auth::user()->lng;
        $users = DB::select(DB::raw("SELECT*,
        ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
        FROM `users` AS u
        where u.lng AND u.lat
        HAVING distance <= {$radius}
        ORDER BY distance ASC")); 

        return view('home.index' , compact('users'));
    }
  
    public function sendFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->insert(
            ['user_id' => $user_id, 'friend_id' => $id]
        );
        return redirect()->intended("/home");
    }
}
