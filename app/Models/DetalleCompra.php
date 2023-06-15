<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    public $fillable  = [
        'id',
        'compra_id',
        'id_insumos',
        'Paquetes',
        'Precio_Paquete',
        'Cantidad',
        'Precio',
    ];

    // public function compra()
    // {
    //     return $this->belongsTo(Compra::class);
    // }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }

}
