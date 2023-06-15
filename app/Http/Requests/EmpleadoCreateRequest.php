<?php

namespace App\Http\Requests;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class EmpleadoCreateRequest extends FormRequest
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
            'Nombre'           => 'required|min:3|max:20',
            'Apellidos'        => 'required|min:3|max:20',
            'Email'            => 'required|email|unique:empleados',
            'Documento'        => 'required|unique:empleados|min:10|max:10|regex:/^[a-zA-Z0-9\s]+$/',
            'Genero'           => 'required',
            'Fecha_Nacimiento' => [
                                'required',
                                'date',
                                Rule::notIn([Carbon::now()->format('Y-m-d')]),
                                function ($attribute, $value, $fail) {
                                    $fecha_nacimiento = Carbon::parse($value);
                                    $edad = $fecha_nacimiento->age;
                                    if ($edad < 18) {
                                        $fail('El usuario debe ser mayor de edad.');
                                    }
                                },
            ],
            'Celular'          => 'required|min:10|max:10',
            'Observaciones',
            'imagen'           => 'required|image|mimes:jpg,png,svg|max:1024',
            'id_tipoempleados' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'Nombre.required' => 'El campo nombre es requerido.',
            'Apellidos.required' => 'El campo apellidos es requerido.',
            'Email.required' => 'El campo email es requerido.',
            'Documento.required' => 'El campo documento es requerido.',
            'Documento.numeric' => 'El campo debe ser numérico.',
            'Documento.min'     => 'El documento debe ser de 10 numeros.',
            'Documento.regex' => 'El campo no puede contener caracteres especiales.',
            'Genero.required' => 'El campo genero es requerido.',
            'Fecha_Nacimiento' => 'El empleado debe ser mayor de edad.',
            'Celular.required' => 'El campo celular es requerido.',
            'imagen.required' => 'El campo imagen es requerido.',
            'id_tipoempleados.required' => 'El campo tipoempleado es requerido.',


        ];
    }
}
