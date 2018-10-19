<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);


        /*DB::table('friends')->where([
            ['accepted', 0],
            ['user_id', '!=',1]
        ])->get();
        */

        //user_id shouldnt be one
        $friendRequests = DB::select( '
            select * from playdates_r_us.users
            where id in (
                    select user_id from playdates_r_us.friends
                    where accepted  = 0 and user_id  != 1
            );
        ');

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
