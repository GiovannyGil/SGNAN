<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable =['id',
        'id_proveedores',
        'id_user',
        'Referencia_compra',
        'Descripcion_compra',
        'total',
    ];
    public function Tproveedor()
    {
        // return $this ->belongsTo(Proveedor::class,'id_proveedores');
        return $this->belongsTo(Proveedor::class);
    }

    // public function TInsumos()
    // {
    //      return $this ->belongsToMany(Insumo::class)
    //         ->withPivot('Cantidad','Precio')
    //         ->withTimestamps();
    // }

    
    public function detalleCompra(){
        return $this->hasMany(DetalleCompra::class);
    }
}