<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;


class UserEditRequest extends FormRequest
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
        $user = $this->route('user');
        return [
            'name' => 'min:3|max:11|',
            'email' => 'unique:users,email,' . $this->user.'|required',
            'password' => 'sometimes',
            'password' => ['nullable', 'confirmed', Password::min(10)
            ->mixedCase()
            ->letters()
            ->numbers(),
        ],
        ];
    }
        public function messages()
        {
            return[
                'name.required' => 'El campo nombre es requerido.',
                'name.min' => 'El campo nombre debe tener al menos 3 caracteres.',
                'name.max' => 'El campo nombre debe ser menor que 11 caracteres.',
                'name.unique' => 'El campo nombre ya ha sido tomado.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
                'roles.required'  => 'El campo roles es requerido.',
    
            ];
        }
    }

