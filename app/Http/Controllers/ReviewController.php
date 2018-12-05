<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Review;
use DB;
use Redirect;
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

        $user1_id = $request->input('user1_id');
        $user2_id = $request->input('user2_id');
        $reviews = DB::select(DB::raw("SELECT * FROM reviews WHERE user1_id = {$user1_id} AND user2_id = {$user2_id}"));
       
        if(empty($reviews)){
        
            $input = $request->all();
            Review::create($input);
            
            $reviews = Review::where('user2_id', 'LIKE' , $request->input('user2_id'))->get();
            $user = User::find($request->input('user2_id'));
        
            return Redirect::to('/ratings/'.$request->input('user2_id'))->with('user', 'reviews');
        }
        else{
            return Redirect::to('/ratings/'.$request->input('user2_id'))->with('user', 'reviews')->with('error', ['You already left a review for this user']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {             
        $this->validate($request, [
            'rating' => 'required',
            'description' => 'required',
            'review_id' => 'required',
            'user2_id' => 'required',
        ]);

        DB::table('reviews')->where('id', $request->input('review_id'))->update(
            [
                'rating' => $request->input('rating'),
                'description' => $request->input('description'),
                    
            ]
        ); 
        $reviews = Review::where('user2_id', 'LIKE' , $request->input('user2_id'))->get();
        $user = User::find($request->input('user2_id'));
        return Redirect::to('/ratings/'.$request->input('user2_id'))->with('user', 'reviews');
    }
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
    public function edit(Request $request)
    {

        $this->validate($request, [
            'userid' => 'required',
        ]);
        $user1_id = Auth::User()->id;
        $user2_id = $request->input('userid');
        $user = User::find($request->input('userid'));
        $reviews = DB::select(DB::raw("SELECT * FROM reviews WHERE user1_id = {$user1_id} AND user2_id = {$user2_id}"));
        $review = $reviews[0];

        return view('ratings.edit', compact('user', 'review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
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
