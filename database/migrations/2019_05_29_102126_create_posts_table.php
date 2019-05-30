<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->index()->default(1)->comment("文章作者,默认为用户1,因为不让前台发文章");
            $table->integer('category_id')->index()->default(1)->comment('文章栏目,暂定默认为1');
            $table->string('title')->unique()->comment('文章标题');
            $table->string('slug')->comment("友好的文章地址");
            $table->string('description')->comment('文章描述');
            $table->string('meta_image')->comment('文章缩略图');
            $table->text('body')->comment("文章内容");
            $table->integer('view_count')->default(0)->cooment("查看数量");
            $table->integer('praise_count')->default(0)->comment("点赞数量");

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
        Schema::dropIfExists('posts');
    }
}
