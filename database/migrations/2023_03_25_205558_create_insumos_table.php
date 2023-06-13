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
        Schema::create('insumos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre_Insumo')->unique();
            $table->double('Precio');
            $table->integer('Cantidad');
            $table->integer('Stock');
            $table->enum('status', ['ACTIVE', 'DEACTIVATED'])->default('ACTIVE');
            $table->timestamps();

            $table->foreignId('id_categorias')
                    ->nullable()
                    ->constrained('categorias')
                    ->cascadeOnUpdate()
                    ->nullOnDelete();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insumos');
    }
};