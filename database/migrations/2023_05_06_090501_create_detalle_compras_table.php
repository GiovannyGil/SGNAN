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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('compra_id')
                ->nullable()
                ->constrained('compras')
                ->cascadeOnUpdate()
                ->noActionOnDelete();

            $table->foreignId('id_insumos')
                ->nullable()
                ->constrained('insumos')
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
        Schema::dropIfExists('detalle_compras');
    }
};
