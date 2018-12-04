<?php

use Illuminate\Database\Seeder;

class GroupUserTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_user')->delete();
        
        \DB::table('group_user')->insert(array (
            0 => 
            array (
                'id' => 1,
                'user_id' => 2,
                'group_id' => 1,
                'created_at' => '2018-12-04 03:53:05',
                'updated_at' => '2018-12-04 03:53:05',
                'is_group_leader' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'user_id' => 5,
                'group_id' => 1,
                'created_at' => '2018-12-04 03:53:05',
                'updated_at' => '2018-12-04 03:53:05',
                'is_group_leader' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'user_id' => 4,
                'group_id' => 1,
                'created_at' => '2018-12-04 03:53:05',
                'updated_at' => '2018-12-04 03:53:05',
                'is_group_leader' => 1,
            ),
            3 => 
            array (
                'id' => 4,
                'user_id' => 1,
                'group_id' => 2,
                'created_at' => '2018-12-04 03:53:13',
                'updated_at' => '2018-12-04 03:53:13',
                'is_group_leader' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'user_id' => 2,
                'group_id' => 2,
                'created_at' => '2018-12-04 03:53:13',
                'updated_at' => '2018-12-04 03:53:13',
                'is_group_leader' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'user_id' => 4,
                'group_id' => 2,
                'created_at' => '2018-12-04 03:53:13',
                'updated_at' => '2018-12-04 03:53:13',
                'is_group_leader' => 1,
            ),
        ));
        
        
    }
}