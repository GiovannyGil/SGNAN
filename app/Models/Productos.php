<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    // proteger campos
    protected $fillable = [
        // llaamar los campos de la tabla
        'id',
        'id_user',
        'NombreProducto',
        'DescripcionProducto',
        'Imagen',
        'PrecioP',
        'Estado'
        
    ];
    // conexion con la tabla detalles
    public function detalles(){
        return $this->hasMany(detalleProducto::class);
    }

    // public function insumo()
    // {
    //     return $this->belongsTo(Insumo::class,'id_insumos');
    // }
}