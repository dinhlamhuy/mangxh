<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school', function (Blueprint $table) {
            $table->increments('school_id');
            $table->string('school_name');
            $table->string('school_category');
            $table->string('school_address')->nullable();
            $table->string('school_phone')->nullable();
            $table->string('school_email')->nullable();
            $table->string('school_link')->nullable();
            $table->longText('school_about')->nullable();
            $table->string('userql');
            $table->string('school_avatar')->nullable()->default('noteimgschool.png');
            $table->string('school_background')->nullable()->default('backgroundschool.jpg');
            $table->string('school_status')->default('1');
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
        Schema::dropIfExists('school');
    }
}
