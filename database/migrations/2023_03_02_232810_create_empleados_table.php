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
        Schema::create('empleados', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Nombre',20 );
            $table->string('Apellidos',11);
            $table->string('Email')->unique();
            $table->string('Documento', 11)->unique();
            $table->string('Genero');
            $table->date('Fecha_Nacimiento');
            $table->string('Celular', 11);
            $table->string('Observaciones');
            $table->string('imagen');
            $table->enum('status', ['ACTIVE', 'DEACTIVATED'])->default('ACTIVE');
            $table->timestamps();

            $table->foreignId('id_tipoempleados')
                    ->nullable()
                    ->constrained('tipoempleados')
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
        Schema::dropIfExists('empleados');
    }
};
