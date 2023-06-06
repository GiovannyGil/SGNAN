<?php

namespace App\Http\Requests\productos;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        return [
            'NombreProducto'          => 'required',
            // 'NombreProducto' => 'unique',
            'DescripcionProducto'        => 'required',
            'PrecioP'            => 'required',
      
        ];
    }

    public function messages()
    {
        return [
            // mensajes de validaciones para el formulario de crear venta
            'NombreProducto.required' => 'El campo producto es requerido',
            // 'NombreProducto.unique' => 'El campo producto debe ser unico',
            'PrecioP.required' => 'El campo precio es requerido',
           
        ];
    }
}
