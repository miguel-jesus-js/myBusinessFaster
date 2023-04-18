<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalesRequest extends FormRequest
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
            'user_id'           => 'required|numeric|exists:users,id',
            'nombre'            => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'correo'            => 'required|min:10|max:50|email|unique:sucursales,correo,'.$this->id,
            'telefono'          => 'required|min:14|max:14|unique:sucursales,telefono,'.$this->id,
            'rfc'               => 'nullable|min:3|max:50|regex:/^([a-z]{3,4})(\d{2})(\d{2})(\d{2})([0-9a-z]{3})$/i|unique:sucursales,rfc,'.$this->id,
            'ciudad'            => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'estado'            => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'municipio'         => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'cp'                => 'required|digits:5|numeric',
            'colonia'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'calle'             => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'n_exterior'        => 'nullable|min:0|max:2000|numeric',
            'n_interior'        => 'nullable|min:0|max:2000|numeric',
        ];
    }
    public function messages()
    {
        return [
            'user_id.required'      => 'Seleccione un responsable',
            'user_id.numeric'       => 'El responsable debe ser un número',
            'user_id.exists'        => 'El responsable no coincide con los usuarios de la base de datos',
            'nombre.required'       => 'Escribe algún nombre',
            'nombre.min'            => 'El nombre debe tener mínimo 3 caracteres',
            'nombre.max'            => 'El nombre debe tener máximo 50 caracteres',
            'nombre.regex'          => 'El nombre debe ser letras sin caracteres especiales',
            'app.required'          => 'Escribe algún apellido',
            'app.min'               => 'El apellido debe tener mínimo 3 caracteres',
            'app.max'               => 'El apellido debe tener máximo 50 caracteres',
            'app.regex'             => 'El apellido debe ser letras sin caracteres especiales',
            'apm.required'          => 'Escribe algún apellido',
            'apm.min'               => 'El apellido debe tener mínimo 3 caracteres',
            'apm.max'               => 'El apellido debe tener máximo 50 caracteres',
            'apm.regex'             => 'El apellido debe ser letras sin caracteres especiales',
            'correo.required'       => 'Escribe algún correo',
            'correo.min'            => 'El correo debe tener mínimo 10 caracteres',
            'correo.max'            => 'El correo debe tener máximo 50 caracteres',
            'correo.email'          => 'El correo no es valido',
            'correo.unique'         => 'El correo ya existe',
            'telefono.required'     => 'Escribe algún telefóno',
            'telefono.min'          => 'El teléfono debe tener mínimo 10 caracteres',
            'telefono.max'          => 'El teléfono debe tener máximo 10 caracteres',
            'telefono.unique'       => 'El teléfono ya existe',
            'rfc.min'               => 'El rfc debe tener mínimo 12 caracteres',
            'rfc.max'               => 'El rfc debe tener máximo 13 caracteres',
            'rfc.regex'             => 'El rfc es invalido',
            'rfc.unique'            => 'El rfc ya existe',
            'ciudad.required'       => 'Escribe alguna ciudad',
            'ciudad.min'            => 'La ciudad debe tener mínimo 3 caracteres',
            'ciudad.max'            => 'La ciudad debe tener máximo 50 caracteres',
            'ciudad.regex'          => 'La ciudad debe ser letras sin caracteres especiales',
            'estado.required'       => 'Escribe algún estado',
            'estado.min'            => 'El estado debe tener mínimo 3 caracteres',
            'estado.max'            => 'El estado debe tener máximo 50 caracteres',
            'estado.regex'          => 'El estado debe ser letras sin caracteres especiales',
            'municipio.required'    => 'Escribe algún municipio',
            'municipio.min'         => 'El municipio debe tener mínimo 3 caracteres',
            'municipio.max'         => 'El municipio debe tener máximo 50 caracteres',
            'municipio.regex'       => 'El municipio debe ser letras sin caracteres especiales',
            'cp.required'           => 'Escribe algún código postal',
            'cp.digits'             => 'El código postal debe tener 5 caracteres',
            'cp.numeric'            => 'El código postal debe ser numeros',
            'colonia.required'      => 'Escribe alguna colonia',
            'colonia.min'           => 'La colonia debe tener mínimo 3 caracteres',
            'colonia.max'           => 'La colonia debe tener máximo 50 caracteres',
            'colonia.regex'         => 'La colonia debe ser letras sin caracteres especiales',
            'calle.required'        => 'Escribe alguna calle',
            'calle.min'             => 'La calle debe tener mínimo 3 caracteres',
            'calle.max'             => 'La calle debe tener máximo 50 caracteres',
            'calle.regex'           => 'La calle debe ser letras sin caracteres especiales',
            'n_exterior.min'        => 'El número exterior debe sey mayor o igual a 0',
            'n_exterior.max'        => 'El número exterior no debe ser mayor a 2000',
            'n_exterior.numeric'    => 'El número exterior debe ser numeros',
            'n_interior.min'        => 'El número interior debe sey mayor o igual a 0',
            'n_interior.max'        => 'El número interior no debe ser mayor a 2000',
            'n_interior.numeric'    => 'El número interior debe ser numeros',
        ];
    }
}
