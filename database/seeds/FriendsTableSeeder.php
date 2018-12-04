<?php

use Illuminate\Database\Seeder;

class FriendsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('friends')->delete();
        
        \DB::table('friends')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user1_id' => 4,
                'user2_id' => 2,
                'created_at' => NULL,
                'updated_at' => NULL,
                'accepted' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'user1_id' => 4,
                'user2_id' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'accepted' => 1,
            ),
            2 => 
            array (
                'id' => 3,
                'user1_id' => 4,
                'user2_id' => 5,
                'created_at' => NULL,
                'updated_at' => NULL,
                'accepted' => 1,
            ),
        ));
        
        
    }
}