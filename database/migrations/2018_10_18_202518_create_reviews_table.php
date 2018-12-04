<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            //User 1 = reviewer
            $table->integer('user1_id')->unsigned();
            $table->foreign('user1_id')->references('id')->on('users');
            //User 2 = User being reviewed
            $table->integer('user2_id')->unsigned();
            $table->foreign('user2_id')->references('id')->on('users');
            $table->decimal('rating', 2, 1);
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
