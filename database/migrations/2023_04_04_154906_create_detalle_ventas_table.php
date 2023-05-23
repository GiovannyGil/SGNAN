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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')
                ->nullable()
                ->constrained('ventas')
                ->cascadeOnUpdate()
                ->noActionOnDelete();
            $table->foreignId('id_producto')
                ->nullable()
                ->constrained('productos')
                ->cascadeOnUpdate()
                ->noActionOnDelete();
            $table->integer('Cantidad');
            $table->decimal('Precio');
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
        Schema::dropIfExists('detalle_ventas');
    }
};
