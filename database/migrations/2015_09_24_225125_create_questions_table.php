<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->text('text');
            $table->integer('user_id')->unsigned();

            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('questions', function(Blueprint $table)
        // {
        //     $table->dropForeign('questions_user_id_foreign');
        // });

        Schema::drop('questions');
    }
}
