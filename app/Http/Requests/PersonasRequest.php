<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonasRequest extends FormRequest
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
            'nombres'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'email'             => 'required|min:10|max:50|email|unique:personas,email,'.$this->id,
            'telefono'          => 'required|min:14|max:14|unique:personas,telefono,'.$this->id,
            'rfc'               => 'nullable|min:3|max:50|regex:/^([a-z]{3,4})(\d{2})(\d{2})(\d{2})([0-9a-z]{3})$/i|unique:personas,rfc,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'nombres.required'      => 'Escribe algún nombre',
            'nombres.min'           => 'El nombre debe tener mínimo 3 caracteres',
            'nombres.max'           => 'El nombre debe tener máximo 50 caracteres',
            'nombres.regex'         => 'El nombre debe ser letras sin caracteres especiales',
            'email.required'        => 'Escribe algún correo',
            'email.min'             => 'El correo debe tener mínimo 10 caracteres',
            'email.max'             => 'El correo debe tener máximo 50 caracteres',
            'email.email'           => 'El correo no es valido',
            'email.unique'          => 'El correo ya existe',
            'telefono.required'     => 'Escribe algún telefóno',
            'telefono.min'          => 'El teléfono debe tener mínimo 10 caracteres',
            'telefono.max'          => 'El teléfono debe tener máximo 10 caracteres',
            'telefono.unique'       => 'El teléfono ya existe',
            'rfc.min'               => 'El rfc debe tener mínimo 12 caracteres',
            'rfc.max'               => 'El rfc debe tener máximo 13 caracteres',
            'rfc.regex'             => 'El rfc es invalido',
            'rfc.unique'            => 'El rfc ya existe',
        ];
    }
}
