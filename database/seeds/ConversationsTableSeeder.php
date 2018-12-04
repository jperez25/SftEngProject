<?php

use Illuminate\Database\Seeder;

class ConversationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('conversations')->delete();
        
        \DB::table('conversations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'group_id' => 1,
                'user_id' => 4,
                'message' => 'How is everyone doing?',
                'created_at' => '2018-12-04 03:53:31',
                'updated_at' => '2018-12-04 03:53:31',
            ),
            1 => 
            array (
                'id' => 2,
                'group_id' => 2,
                'user_id' => 4,
                'message' => 'Whats up?',
                'created_at' => '2018-12-04 03:53:47',
                'updated_at' => '2018-12-04 03:53:47',
            ),
            2 => 
            array (
                'id' => 3,
                'group_id' => 1,
                'user_id' => 2,
                'message' => 'Good.',
                'created_at' => '2018-12-04 03:54:55',
                'updated_at' => '2018-12-04 03:54:55',
            ),
            3 => 
            array (
                'id' => 4,
                'group_id' => 2,
                'user_id' => 2,
                'message' => 'Yo',
                'created_at' => '2018-12-04 03:56:04',
                'updated_at' => '2018-12-04 03:56:04',
            ),
        ));
        
        
    }
}