<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use DB;
use Redirect;
use App\Review;
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

    public function update($id, Request $request)
    {   
        $user = User::find(Auth::user()->getId());

        if($request->input('flag') == 'flag') {
        DB::table('users')->where('id', $id)->update(
                [
                    'flag' => 1
                ]
            );
        Redirect::to('/profile/'.$user->id);
        }

        if($request->input('unflag') == 'unflag') {
        DB::table('users')->where('id', $id)->update(
                [
                    'flag' => 0
                ]
            );
        $users = User::where('flag', 'LIKE' , 1)->get();
        return view('admin.index', compact('users'));
        }
                  

        $request->validate([
                'name' => 'required',
                'image' => '|image|mimes:jpeg,png,jpg,svg|max:2048',
                'bio' => 'required',
                'child_bio' => 'required',
                'parent_age' => 'required|integer|min:18',
                'city' => 'required',
                'state' => 'required',
                'child_age' => 'required|integer|between:1,8',
                
        ]);
        if($request->hasFile('image')) {
            $user_picture = base64_encode(file_get_contents($request->file('image')));
            $user_picture_type = $_FILES['image']['type'];

            DB::table('users')->where('id', $id)->update(
                [
                    'user_picture' => $user_picture,
                    'user_picture_type' => $user_picture_type
                ]
            );
        }
        

        $name = $request->input('name');
        $bio = $request->input('bio');
        $child_bio = $request->input('child_bio');
        $parent_age = $request->input('parent_age');
        $city = $request->input('city');
        $state = $request->input('state');
        $child_age = $request->input('child_age');
        $geocoder = new \OpenCage\Geocoder\Geocoder('8c0bbd03698f4bdaa4e35fe38c30fbd1');
        $result = $geocoder->geocode($city . ' ' . $state);
        $first = $result['results'][0];
        $lat = $first['geometry']['lat'];
        $lng = $first['geometry']['lng'];
        //$level = 1;        
        
        
        DB::table('users')->where('id', $id)->update(
            [
                'name' => $name,
                'bio' => $bio,
                'child_bio' => $child_bio,
                'parent_age' => $parent_age,
                'city' => $city,
                'state' => $state,
                'child_age' => $child_age,
                'lat' => $lat,
                'lng' => $lng,
                    
            ]
        ); 
       return redirect('/profile');
    }

    public function show($userID)
    {
        $user = User::find($userID);
        return view('profile.show',compact('user'));
    }
    public function destroy($userID)
    {

        $user = User::find($userID);
        $reviews = Review::where('user2_id', 'LIKE' , $userID)->get();
            while (count($reviews) > 0) {
              foreach ($reviews as $review) {
                $review->delete();
            }
        }
        $user->delete(); 
        $users = User::where('flag', 'LIKE' , 1)->get();
        return view('admin.index', compact('users'));
    }
}

