<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('question_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->integer('points');
            $table->text('text');

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('answers_points_user', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

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
        Schema::table('answers_points_user', function(Blueprint $table)
        {
            $table->dropForeign('answers_points_user_answer_id_foreign');
            $table->dropForeign('answers_points_user_user_id_foreign');
        });

        Schema::table('answers', function(Blueprint $table)
        {
            $table->dropForeign('answers_question_id_foreign');
            // $table->dropForeign('answers_user_id_foreign');
        });

        Schema::drop('answers_points_user');
        Schema::drop('answers');
    }
}
