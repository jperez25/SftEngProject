<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;
use App\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(User $user)
    {
        Schema::defaultStringLength(191);


        /*DB::table('friends')->where([
            ['accepted', 0],
            ['user_id', '!=',1]
        ])->get();
        */
        $id = $user->id ? $user->id : 1;

        

        //user_id shouldnt be one
        if (Auth::check()) {
            $id = Auth::id();
        }

        $friendRequests = DB::select(DB::raw("SELECT * FROM users WHERE id IN 
            (SELECT user1_id FROM friends
             WHERE accepted = 0 AND user1_id != " . $id . ")"
         )); 
         
        view()->share('friendRequests', $friendRequests);
        
        

        

        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
