<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Group;
use Illuminate\Http\Request;
use App\User;
use Auth;
use DB;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$friends = Auth::user()->friends();
       $friends = DB::select( '
            select * from playdates_r_us.users
            where id in (
                    select user1_id from playdates_r_us.friends
                    where accepted  = 1 and (user1_id  = ' .Auth::user()->id.' or user2_id = ' . Auth::user()->id . ')
            );
        ');        
        
        //return view('chat.index')->withFriends($friends);
        
        $groups = auth()->user()->groups;

        $users = collect($friends);
        
        $user = auth()->user();

        return view('group', ['groups' => $groups, 'users' => $users, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $group = Group::create(['name' => request('name')]);

        $users = collect(request('users'));
        $users->push(auth()->user()->id);

        $group->users()->attach($users);

        broadcast(new GroupCreated($group))->toOthers();

        return $group;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
