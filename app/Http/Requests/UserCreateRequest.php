<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserCreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:11|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', Password::min(10)
            ->mixedCase()
            ->letters()
            ->numbers(),
        ],
            'password_confirmation'  => 'required',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El campo nombre es requerido.',
            'name.min' => 'El campo nombre debe tener al menos 3 caracteres.',
            'name.max' => 'El campo nombre debe ser menor que 11 caracteres.',
            'name.unique' => 'El campo nombre ya ha sido tomado.',
            'password.required' => 'El campo contraseña es requerido.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password_confirmation' => 'El campo confirmar contraseña es requerido.',
            'roles.required'  => 'El campo roles es requerido.'
            

        ];
    }
}
