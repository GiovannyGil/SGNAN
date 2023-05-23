<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleProducto extends Model
{
    use HasFactory;
    protected $fillable =[
        'id',
        'productos_id',
        'id_insumos',
        'Cantidad'

        
    ];
    
    // public function producto()
    // {
    //     return $this->belongsTo(Productos::class);
    // }
    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}