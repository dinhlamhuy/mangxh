<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
            $table->unsignedInteger('user_from');
            $table->unsignedInteger('user_to');
            $table->integer('f_trangthai');
            $table->string('f_ghichu');
            $table->timestamps();

            $table->primary(['user_from','user_to']);

            $table->foreign('user_from')->references('user_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('user_to')->references('user_id')->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('friend');
    }
}
