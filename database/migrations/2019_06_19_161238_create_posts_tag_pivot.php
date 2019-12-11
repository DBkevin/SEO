<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTagPivot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts_tag_pivot', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('posts_id')->unsigned()->index()->comment('文章ID,索引');
            $table->integer('tags_id')->unsigned()->index()->comment("tag标签ID");
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
        Schema::dropIfExists('posts_tag_pivot');
    }
}
