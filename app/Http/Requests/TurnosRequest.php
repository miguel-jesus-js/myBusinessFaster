<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnosRequest extends FormRequest
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
            'turno' => 'required|min:5|max:20|regex:/^[\pL\s]+$/u',
            'hora'  => 'required|min:3|max:200',
        ];
    }
    public function messages()
    {
        return [
            'turno.required'    => 'Escribe algún turno',
            'turno.min'         => 'El turno debe tener mínimo 5 caracteres',
            'turno.max'         => 'El turno debe tener máximo 15 caracteres',
            'turno.regex'       => 'El turno debe ser letras sin caracteres especiales',
            'hora.required'     => 'Escribe algún horario',
            'hora.min'          => 'El horario debe tener mínimo 5 caracteres',
            'hora.max'          => 'El horario debe tener máximo 50 caracteres',
            //'hora.regex'        => 'El horario debe ser letras sin caracteres especiales',
        ];
    }
}
