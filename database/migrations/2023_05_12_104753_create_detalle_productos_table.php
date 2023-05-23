<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            //producto
            $table->foreignId('productos_id')
                ->nullable()
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->noActionOnDelete();
            //insumos
            $table->foreignId('id_insumos')
                ->nullable()
                ->constrained('insumos')
                ->cascadeOnUpdate()
                ->noActionOnDelete();

            $table->integer('Cantidad');
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
        Schema::dropIfExists('detalle_productos');
    }
};
