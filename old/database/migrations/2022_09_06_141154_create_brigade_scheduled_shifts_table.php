<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrigadeScheduledShiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brigade_scheduled_shifts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_shift_id');
            $table->unsignedBigInteger('brigade_id');
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
        Schema::dropIfExists('brigade_scheduled_shifts');
    }
}
