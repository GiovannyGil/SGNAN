<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;
    public function categorias()
    {
        return $this->belongsTo(Categoria::class, 'id_categorias');
    }
    protected $fillable =[
        // llamar los campos de la tabla
        'id',
        'Nombre_Insumo',
        'Stock',
        'Cantidad',
        'status',

    ];

    // public function compra()
    // {
    //     return $this->belongsToMany(Compra::class,'id')
    //         ->withPivot('Cantidad','Precio')
    //         ->withTimestamps();
    // }

}