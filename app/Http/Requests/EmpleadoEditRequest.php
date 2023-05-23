<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $empleado = $this->route('empleado');
        return [
            'Nombre'           => 'required|min:3|max:20',
            'Apellidos'        => 'required|min:3|max:20',
            'Email'            => 'unique:empleados,Email,'.$this->empleado.'|required',
            'Documento'        => 'required|min:10|max:10|unique:empleados,Documento,' .$this->empleado.'|required' ,
            'Genero'           => 'required',
            'Fecha_Nacimiento' => 'required',
            'Celular'          => 'required|min:10|max:10',
            'Observaciones',
            'imagen'           => 'image|mimes:jpg,png,svg|max:1024'
        ];
    }

    
}
