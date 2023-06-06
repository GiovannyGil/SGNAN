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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('NombreProducto')->unique()->length(30);
            $table->string('DescripcionProducto')->length(30);
            $table->string('imagen')->nullable();
            $table->decimal('PrecioP')->length(20);
            $table->enum('Estado', ['Activo', 'Inhactivo'])->default('Activo');
            $table->timestamps();

            $table->foreignId('id_insumos')
            ->nullable()
            ->constrained('insumos')
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
        Schema::dropIfExists('productos');
    }
};