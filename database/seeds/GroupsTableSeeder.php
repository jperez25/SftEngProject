<?php

use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('groups')->delete();
        
        \DB::table('groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Lewis and Sage',
                'created_at' => '2018-12-04 03:53:05',
                'updated_at' => '2018-12-04 03:53:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Akira and Lewis',
                'created_at' => '2018-12-04 03:53:13',
                'updated_at' => '2018-12-04 03:53:13',
            ),
        ));
        
        
    }
}