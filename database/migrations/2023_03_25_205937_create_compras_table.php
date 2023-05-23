<?php

use App\Models\Compra;
use App\Models\Proveedor;
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
        Schema::create('compras', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('id_proveedores')
                    ->nullable()
                    ->constrained('proveedors')
                    ->cascadeOnUpdate()
                    ->noActionOnDelete();
                $table->foreignId('id_user')
                    ->nullable()
                    ->constrained('users')
                    ->cascadeOnUpdate()
                    ->noActionOnDelete();
                $table->string('Referencia_compra')->unique();
                $table->string('Descripcion_compra');
                $table->decimal('total');
                $table->enum('status', ['ACTIVE', 'DEACTIVATED'])->default('ACTIVE');
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
        Schema::dropIfExists('compras');
    }
};