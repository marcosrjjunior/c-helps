<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->nullableTimestamps();
        });

        Schema::create('question_tags', function (Blueprint $table) {
            $table->integer('question_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

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
        Schema::table('question_tags', function(Blueprint $table)
        {
            $table->dropForeign('question_tags_question_id_foreign');
            $table->dropForeign('question_tags_tag_id_foreign');
        });

        Schema::drop('question_tags');
        Schema::drop('tags');
    }
}
