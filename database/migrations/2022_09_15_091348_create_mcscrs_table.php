<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMcscrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mcscrs', function (Blueprint $table) {
            $table->id();
            $table->text('motivo');
            $table->text('causa')->nullable();
            $table->text('solucao')->nullable();
            $table->text('consequencia')->nullable();
            $table->text('recomendacao')->nullable();
            $table->text('obs')->nullable();
            $table->decimal('custo_material',8,2)->nullable();
            $table->decimal('custo_mao_obra',8,2)->nullable();
            $table->bigInteger('user_id');
            $table->bigInteger('status');
            $table->bigInteger('equipment_id');
            $table->unsignedBigInteger('destination_id');
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('waiting_id')->nullable();
            $table->timestamp('open_at');
            $table->timestamp('close_at')->nullable();
            $table->timestamp('open_at_man');
            $table->timestamp('close_at_man')->nullable();
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
        Schema::dropIfExists('mcscrs');
    }
}
