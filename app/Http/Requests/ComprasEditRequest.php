<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComprasEditRequest extends FormRequest
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
            
            $compra = $this->route('compra');
            return [
            'Referencia_compra'   => 'required',
            'Fecha_compra'        => 'required',
            'Cantidad'            =>'required',
            'Precio_unitario'     => 'required' ,
            
            
        ];
    }
}