<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriasCreateRequest extends FormRequest
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
            'Nombre'     => 'required|min:3|max:30|unique:categorias',
            

        ];
    }
    public function messages()
    {
        return[
            'Nombre.required' => 'El campo nombre categoria es requerido.',
        ];
    }
}