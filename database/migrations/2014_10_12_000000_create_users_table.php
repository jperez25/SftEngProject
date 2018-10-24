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
            $table->string('name');            
            $table->string('email')->unique();
            $table->boolean('verified')->default(false);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->enum('gender', ['Male', 'Female', 'Other']);
            $table->text('bio')->nullable();
            $table->integer('child_age')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->text('child_bio')->nullable();
            $table->integer('parent_age')->nullable();
            $table->string('user_picture_type')->nullable(); 
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
