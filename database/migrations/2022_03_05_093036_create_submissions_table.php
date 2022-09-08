<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->increments('sm_id');
            $table->longText('sm_noidung')->nullable();
            $table->string('sm_file')->nullable();
            $table->string('sm_typefile')->nullable();
            $table->dateTime('sm_ngaynop');
            $table->unsignedInteger('nguoinop_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('gw_id');
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
        Schema::dropIfExists('submissions');
    }
}
