<?php

namespace App\Http\Requests\productos;

use Illuminate\Foundation\Http\FormRequest;

class ProductoEditRequest extends FormRequest
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
        $producto = $this->route('producto');
        return [
            'NombreProducto'      => 'required',
            'NombreProducto'      => 'unique:productos,NombreProducto|min:5|max:10',
            'PrecioP'             => 'required|min:3|max:10',
            
      
        ];
    }

    public function messages()
    {
        return [
            // mensajes de validaciones para el formulario de crear producto
            'NombreProducto.required' => 'El campo producto es requerido',
            'NombreProducto.unique'   => 'El campo producto debe ser unico',
            'PrecioP.required'        => 'El campo precio es requerido',
            
        ];
    }
}
