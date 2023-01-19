<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('make');
            $table->string('model');
            $table->string('type');
            $table->string('serial');
            $table->string('chassis');
            $table->string('year');
            $table->string('load_max');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('status');
            $table->unsignedBigInteger('mobilized')->nullable();
            $table->string('omnicom_id')->nullable();
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
        Schema::dropIfExists('equipment');
    }
}
