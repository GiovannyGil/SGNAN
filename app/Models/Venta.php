<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    public $fillable = ['id',
        'id_empleado',
        'id_user',
        'total',
        'Estado',
        'created_at',
    ];

    // relaciones

    // la venta esta hecha por un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // detalles de la venta
    public function detalleVentas()
    {
        return $this->hasMany(DetalleVenta::class);
    }

}
