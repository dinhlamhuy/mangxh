<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_work', function (Blueprint $table) {
            $table->increments('gw_id');
            $table->string('gw_tieude');
            $table->longText('gw_noidung')->nullable();
            $table->dateTime('gw_hannop');
            $table->string('gw_file')->nullable();
            $table->string('gw_typefile')->nullable();
            $table->unsignedInteger('nguoitao_id');
            $table->unsignedInteger('group_id');
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
        Schema::dropIfExists('group_work');
    }
}
