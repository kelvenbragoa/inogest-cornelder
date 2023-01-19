<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquimentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equiment_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('scheduled_shift_id');
            $table->unsignedBigInteger('equipment_id');
            $table->unsignedBigInteger('qtd');
            $table->unsignedBigInteger('qtd_real');
            $table->unsignedBigInteger('status');
            $table->text('obs');
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
        Schema::dropIfExists('equiment_requests');
    }
}
