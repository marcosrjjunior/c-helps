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
            $table->timestamps();
        });

        Schema::create('answers_tags', function (Blueprint $table) {
            $table->integer('answer_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('answer_id')->references('id')->on('answers')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

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
        Schema::table('answers_tags', function(Blueprint $table)
        {
            $table->dropForeign('answers_tags_answer_id_foreign');
            $table->dropForeign('answers_tags_tag_id_foreign');
        });

        Schema::drop('answers_tags');
        Schema::drop('tags');
    }
}
