<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Review;
use DB;
class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::where('user2_id', 'LIKE' , Auth::User()->id)->get();

        return view('ratings.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::find($request->input('userid'));
        return view('ratings.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, [
            'rating' => 'required',
            'description' => 'required',
            'user2_id' => 'required',
            'user1_id' => 'required',
        ]);
        $input = $request->all();
        Review::create($input);
        $reviews = Review::where('user2_id', 'LIKE' , $request->input('user2_id'))->get();
        $user = User::find($request->input('user2_id'));
        return view('ratings.show',compact('user', 'reviews'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($userID)
    {
        $reviews = Review::where('user2_id', 'LIKE' , $userID)->get();
        $user = User::find($userID);
        return view('ratings.show',compact('user', 'reviews'));
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
