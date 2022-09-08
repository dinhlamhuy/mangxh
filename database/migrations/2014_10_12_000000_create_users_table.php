<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            // $table->charset = 'utf8mb4';
            // $table->collation = 'utf8mb4_unicode_ci';
            
            $table->increments('user_id');
            $table->string('firstname');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('sex');
            $table->string('avatar')->nullable()->default('noteimg.png');
            $table->string('background')->nullable()->default('noimg.jpg');
            $table->string('job')->nullable();
            $table->string('class')->nullable();
            $table->unsignedInteger('school_id')->nullable();
            $table->string('interests')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->date('birthday');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
