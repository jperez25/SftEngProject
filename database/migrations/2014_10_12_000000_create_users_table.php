<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //change to longblob
            $table->string('userPictureType')->nullable();
            $table->string('name');            
            $table->string('email')->unique();
            $table->boolean('verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->text('bio')->nullable();
            $table->integer('child_age')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('child_bio')->nullable();
            $table->integer('parent_age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
