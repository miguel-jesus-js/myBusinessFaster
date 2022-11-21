<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionesEntregasRequest extends FormRequest
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
            'ciudad1'            => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'estado1'            => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'municipio1'         => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'cp1'                => 'required|digits:5|numeric',
            'colonia1'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'calle1'             => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'n_exterior1'        => 'nullable|min:0|max:2000|numeric',
            'n_interior1'        => 'nullable|min:0|max:2000|numeric',
        ];
    }
    public function messages()
    {
        return [
            'ciudad1.required'       => 'Escribe alguna ciudad',
            'ciudad1.min'            => 'La ciudad debe tener mínimo 3 caracteres',
            'ciudad1.max'            => 'La ciudad debe tener máximo 50 caracteres',
            'ciudad1.regex'          => 'La ciudad debe ser letras sin caracteres especiales',
            'estado1.required'       => 'Escribe algún estado',
            'estado1.min'            => 'El estado debe tener mínimo 3 caracteres',
            'estado1.max'            => 'El estado debe tener máximo 50 caracteres',
            'estado1.regex'          => 'El estado debe ser letras sin caracteres especiales',
            'municipio1.required'    => 'Escribe algún municipio',
            'municipio1.min'         => 'El municipio debe tener mínimo 3 caracteres',
            'municipio1.max'         => 'El municipio debe tener máximo 50 caracteres',
            'municipio1.regex'       => 'El municipio debe ser letras sin caracteres especiales',
            'cp1.required'           => 'Escribe algún código postal',
            'cp1.digits'             => 'El código postal debe tener 5 caracteres',
            'cp1.numeric'            => 'El código postal debe ser numeros',
            'colonia1.required'      => 'Escribe alguna colonia',
            'colonia1.min'           => 'La colonia debe tener mínimo 3 caracteres',
            'colonia1.max'           => 'La colonia debe tener máximo 50 caracteres',
            'colonia1.regex'         => 'La colonia debe ser letras sin caracteres especiales',
            'calle1.required'        => 'Escribe alguna calle',
            'calle1.min'             => 'La calle debe tener mínimo 3 caracteres',
            'calle1.max'             => 'La calle debe tener máximo 50 caracteres',
            'calle1.regex'           => 'La calle debe ser letras sin caracteres especiales',
            'n_exterior1.min'        => 'El número exterior debe sey mayor o igual a 0',
            'n_exterior1.max'        => 'El número exterior no debe ser mayor a 2000',
            'n_exterior1.numeric'    => 'El número exterior debe ser numeros',
            'n_interior1.min'        => 'El número interior debe sey mayor o igual a 0',
            'n_interior1.max'        => 'El número interior no debe ser mayor a 2000',
            'n_interior1.numeric'    => 'El número interior debe ser numeros',
        ];
    }
}
