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
        
        $user_id = Auth::user()->id;
        $lat = Auth::user()->lat;
        $lng = Auth::user()->lng;
        $radius = 50;
        $users = DB::select(DB::raw("SELECT*,
        ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
        FROM `users` AS u
        where u.lng AND u.lat and u.id not in 
                                        (SELECT id FROM `users` as user WHERE user.id = {$user_id})
        HAVING distance <= {$radius}
        ORDER BY distance ASC"));       
                
        return view('home.index',compact('users', 'radius'));
    }
    public function search(Request $request)
    {
        $user_id = Auth::user()->id;
        $radius = (int)$request->input('radius');
        $lat = Auth::user()->lat;
        $lng = Auth::user()->lng;
        $users = DB::select(DB::raw("SELECT*,
        ( 3959 * acos( cos( radians({$lat}) ) * cos( radians( `lat` ) ) * cos( radians( `lng` ) - radians({$lng}) ) + sin( radians({$lat}) ) * sin( radians( `lat` ) ) ) ) AS distance
        FROM `users` AS u
        where u.lng AND u.lat and u.id not in 
                                        (SELECT id FROM `users` as user WHERE user.id = {$user_id})
        HAVING distance <= {$radius}
        ORDER BY distance ASC")); 

        return view('home.index' , compact('users', 'radius'));
    }
  
    public function sendFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->insert(
            ['user1_id' => $user_id, 'user2_id' => $id]
        );
        return redirect()->intended("/home");
    }

    public function acceptFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->where(
            ['user1_id' => $id, 'user2_id' => $user_id]
        )->update(['accepted'=>1]);
        return redirect()->intended("/home");
    }
}
