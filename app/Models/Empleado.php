<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    public function tipoempleados()
    {
        return $this->belongsTo(Tipoempleado::class, 'id_tipoempleados');
    }

    protected $fillable =[
        'Nombre',
        'Apellidos',
        'Email',
        'Documento',
        'Genero',
        'Fecha_Nacimiento',
        'Celular',
        'Observaciones',
        'Created_at',
        'id_tipoempleados',
        'status'
    ];
}
