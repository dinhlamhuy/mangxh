<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->increments('post_id');
            $table->longText('caption')->nullable();
            $table->integer('post_choduyet',1)->default('0')->comment('0: chưa duyệt 1: đã duyệt')->nullable();
            $table->string('status')->nullable();
            $table->string('type_post')->default('1')->comment('1: bài đăng cá nhân, 2: bài đăng nhóm, 3: bài đăng fanpage');
            $table->string('category_post')->default('1')->comment('1: bài đăng cá nhân, 2: bài đăng nhóm, 3: bài đăng fanpage');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedInteger('school_id')->nullable();
            $table->unsignedInteger('sharepost_id')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users');
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
