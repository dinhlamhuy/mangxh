<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSanphamTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sanpham', function (Blueprint $table) {
            $table->increments('sp_id');
            $table->string('sp_ten');
            $table->string('sp_gia');
            $table->longText('sp_mota');
            $table->string('sp_soluong');
            $table->string('sp_sdt');
            $table->string('sp_tinhtrang');
            $table->string('sp_diachi');
            $table->unsignedInteger('nguoiban') ;
            $table->unsignedInteger('phanloai') ;
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
        Schema::dropIfExists('sanpham');
    }
}
