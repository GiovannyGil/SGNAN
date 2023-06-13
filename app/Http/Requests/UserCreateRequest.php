<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'password' => 'required|confirmed|max:10',
            'password_confirmation'  => 'required',
            'roles' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'El campo nombre es requerido.',
            'password.required' => 'El campo contraseña es requerido.',
            'roles.required'  => 'El campo roles es requerido.'

        ];
    }
}
