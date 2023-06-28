<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprasCreateRequest extends FormRequest
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
            'Referencia_compra'     =>'required|min:3|max:11|unique:compras',
            'Fecha_compra'          =>'required|after:today',
            'Cantidad'              =>'required',
            'Precio_unitario'       =>'required',


        ];
        
    }
    public function messages()
    {
        return[
            'Referencia_compra.unique' => 'El campo refrencia debe ser unico.',
         


        ];
    }
}