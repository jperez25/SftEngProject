<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $users = factory(App\User::class, 100)->create();
        $friends = factory(App\Friend::class, 300)->create();
        $chats = factory(App\Chat::class, 500)->create();
    }
}
