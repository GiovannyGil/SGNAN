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
            $table->integer('Cantidad')->default(0)->nullable();
            $table->integer('Stock')->default(10)->nullable();
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