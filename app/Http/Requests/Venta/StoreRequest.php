<?php

namespace App\Http\Requests\Venta;

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
            //
            // validaciones para el formulario de crear venta
            'id_empleado',
            'id_user',
            'id_producto',
            'Cantidad',
        ];
    }
    public function messages()
    {
        return [
            // mensajes de validaciones para el formulario de crear venta
            'id_empleado.required' => 'El campo empleado es requerido',
            'id_user.required' => 'El campo usuario es requerido',
            'id_producto.required' => 'El campo producto es requerido',
            'Cantidad.required' => 'El campo cantidad es requerido',
        ];
    }
}