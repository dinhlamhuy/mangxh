<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment', function (Blueprint $table) {
            $table->increments('cmt_id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->longText('cmt_noidung');
            $table->string('cmt_hinhanh')->nullable();
            $table->unsignedInteger('cmt_reply')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('cmt_reply')->references('user_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment');
    }
}
