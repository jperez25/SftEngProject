<?php

namespace App\Http\Controllers;

use App\Friend;
use Auth;
use Illuminate\Http\Request;
use DB;

class FriendController extends Controller
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

        return view('friend', ['users' => $users, 'user' => $user]);
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
        // validate

        // add to database
        $friend = new Friend;
        $friend->user1_id = Auth::user()->id;
        $friend->user2_id = $request->user2_id;
        $friend->save();

        // success message and return
        Session::flash('success', 'Friend has been added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show(Friend $friend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
