<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaocaopostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baocaopost', function (Blueprint $table) {
            $table->increments('rp_id'); 
            $table->unsignedInteger('post_id'); 
            $table->unsignedInteger('user_tocao'); 
            $table->string('rp_tieude'); 
            $table->string('rp_noidung'); 
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
        Schema::dropIfExists('baocaopost');
    }
}
