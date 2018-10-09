<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE users
        ADD userPicture LONGBLOB,
        ADD lat decimal(30,20),
        ADD lng decimal(30,20);");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE users
        DROP COLUMN userPicture,
        DROP COLUMN lat,
        DROP COLUMN lng;");
    }
}
