<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaocaoviphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('baocaovipham', function (Blueprint $table) {
            $table->increments('bcvp_id'); 
            $table->unsignedInteger('user_id')->nullable(); 
            $table->unsignedInteger('school_id')->nullable(); 
            $table->unsignedInteger('group_id')->nullable(); 
            $table->Integer('bcvp_catory')->nullable(); 
            $table->unsignedInteger('user_tocao'); 
            $table->string('bcvp_tieude'); 
            $table->string('bcvp_noidung'); 
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
        Schema::dropIfExists('baocaovipham');
    }
}
