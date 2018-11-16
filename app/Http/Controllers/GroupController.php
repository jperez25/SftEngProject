<?php

namespace App\Http\Controllers;

use App\Events\GroupCreated;
use App\Events\GroupDeleted;
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
        $friends = DB::select(DB::raw("SELECT * FROM users WHERE users.id IN 
        ( SELECT user1_id as us FROM friends
            WHERE accepted = 1 AND user2_id = " . Auth::user()->id ."
        
            union
            
            SELECT user2_id as us FROM friends
                WHERE accepted = 1 AND user1_id = " . Auth::user()->id ."
            );"
         ));       
        
        
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

    public function delete_group($group_id)
    {
        $group = Group::find($group_id);
        


        broadcast(new GroupDeleted($group))->toOthers();

        DB::select(DB::raw(" DELETE FROM group_user WHERE group_id = {$group_id};"
         ));  

         DB::select(DB::raw("DELETE FROM conversations WHERE group_id = {$group_id};"
         ));

         DB::select(DB::raw("DELETE FROM groups WHERE id = {$group_id};"
         ));
         
         return redirect()->intended("/group");
    }
}
