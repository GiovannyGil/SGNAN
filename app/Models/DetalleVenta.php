<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;
    public $fillable = ['id',
        'venta_id',
        'id_producto',
        'Cantidad',
        'Precio',
    ];
    // relaciones
    // productos
    public function producto()
    {
        return $this->belongsTo(producto::class);
    }
}
