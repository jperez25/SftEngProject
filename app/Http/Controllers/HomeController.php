<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use DB;
use App\Events\NewRequest;

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
                
        $friends = DB::select(DB::raw(
            "select user1_id, user2_id, accepted from friends where user1_id = {$user_id} or user2_id = {$user_id}"
        ));
        
        return view('home.index' , compact('users', 'radius', 'friends'));
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

        $friends = DB::select(DB::raw(
            "select user1_id, user2_id, accepted from friends where user1_id = {$user_id} or user2_id = {$user_id}"
        ));

        return view('home.index' , compact('users', 'radius', 'friends'));
    }
  
    public function sendFriendReq($id)
    {
        $user_id = Auth::user()->id;
        $wasReqSent = DB::table('friends')->where(
            ['user1_id' => $user_id, 'user2_id' => $id]
        )->get();        

        if ($wasReqSent->count()) {
            //do nothing, req already sent
        } else {
            DB::table('friends')->insert(
                ['user1_id' => $user_id, 'user2_id' => $id]
            );
        }
        broadcast(new NewRequest($user_id, $id));

        return redirect()->back();
    }

    public function acceptFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->where(
            ['user1_id' => $id, 'user2_id' => $user_id]
        )->update(['accepted'=>1]);

        return redirect()->back();
    }

    public function deleteFriendReq($id)
    {
        $user_id = Auth::user()->id;
        DB::table('friends')->where(
            ['user1_id' => $id, 'user2_id' => $user_id]
        )->delete();
        DB::table('friends')->where(
            ['user2_id' => $id, 'user1_id' => $user_id]
        )->delete();

        return redirect()->back();
    }

    public function fetchReqs()
    {
        $friendRequests = DB::select(DB::raw("SELECT * FROM users WHERE id IN 
            (SELECT user1_id FROM friends
             WHERE accepted = 0 AND user2_id = " . Auth::user()->id . ")"
         ));

         return $friendRequests;
    }

    public function getOwner($group_id)
    {
        $owner = DB::select(DB::raw("SELECT user_id FROM group_user WHERE group_id = " . $group_id .  " AND is_group_leader = 1;"
         ));         

         return $owner;
    }
    public function getFriends()
    {
        $group_id = request('group_id');        
        /* Alternative query
        select * from users, (
            SELECT user1_id, user2_id FROM friends
                WHERE accepted = 1 AND (user1_id = 1 or user2_id = 1)) as frienships where (id = frienships.user1_id or id = frienships.user2_id) and id <> 1;
        */
        $group_id = request('group_id');
        $friends = DB::select(DB::raw("SELECT DISTINCT users.* FROM friends 
        JOIN users ON friends.user1_id = users.id OR friends.user2_id = users.id 
                where friends.accepted = 1 AND (friends.user1_id = ". Auth::user()->id." OR friends.user2_id =". Auth::user()->id.") AND users.id <>  ". Auth::user()->id." AND users.id NOT IN (SELECT user_id FROM group_user WHERE group_user.group_id = {$group_id});"
        ));
        
         return $friends;
    }
    public function addFriends()
    {
        $group_id = request('group_id');
        $friends = request('friends');

        foreach ($friends as $array => $id) {
            DB::statement(DB::raw("INSERT into group_user (user_id, group_id) values ({$id}, {$group_id});"
         ));
        }
    }
    public function deleteGroupMembers()
    {
        $group_id = request('group_id');
        $friends = request('friends');

        foreach ($friends as $array => $id) {
            DB::statement(DB::raw(" DELETE FROM group_user WHERE group_id = {$group_id} and user_id = {$id};"
         ));
        }


    }
    public function getMembersOfGroup($group_id)
    {
        $groupMem = DB::select(DB::raw("SELECT * FROM users WHERE id IN
        (select user_id from group_user where group_id = {$group_id} and user_id != " . Auth::user()->id. ");"));
        
         return $groupMem;
    }
    public function getCurrentUser()
    {
        return Auth::user();
    }
    public function leave_group()
    {
        
    }
}
