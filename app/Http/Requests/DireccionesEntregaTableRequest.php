<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DireccionesEntregaTableRequest extends FormRequest
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
            'ciudad'            => 'required|array|min:1',
            'ciudad.*'          => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'estado'            => 'required|array|min:1',
            'estado.*'          => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'municipio'         => 'required|array|min:1',
            'municipio.*'       => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'cp'                => 'required|array|min:1',
            'cp.*'              => 'required|digits:5|numeric',
            'colonia'           => 'required|array|min:1',
            'colonia.*'         => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'calle'             => 'required|array|min:1',
            'calle.*'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'n_exterior'        => 'nullable|array|min:1',
            'n_exterior.*'      => 'nullable|min:0|max:2000|numeric',
            'n_interior'        => 'nullable|array|min:1',
            'n_interior.*'      => 'nullable|min:0|max:2000|numeric',
        ];
    }
    public function messages()
    {
        return [
            'ciudad.required'       => 'Escribe alguna ciudad',
            'ciudad.*.min'            => 'La ciudad debe tener mínimo 3 caracteres',
            'ciudad.*.max'            => 'La ciudad debe tener máximo 50 caracteres',
            'ciudad.*.regex'          => 'La ciudad debe ser letras sin caracteres especiales',
            'estado.required'       => 'Escribe algún estado',
            'estado.*.min'            => 'El estado debe tener mínimo 3 caracteres',
            'estado.*.max'            => 'El estado debe tener máximo 50 caracteres',
            'estado.*.regex'          => 'El estado debe ser letras sin caracteres especiales',
            'municipio.required'    => 'Escribe algún municipio',
            'municipio.*.min'         => 'El municipio debe tener mínimo 3 caracteres',
            'municipio.*.max'         => 'El municipio debe tener máximo 50 caracteres',
            'municipio.*.regex'       => 'El municipio debe ser letras sin caracteres especiales',
            'cp.required'           => 'Escribe algún código postal',
            'cp.*.digits'             => 'El código postal debe tener 5 caracteres',
            'cp.*.numeric'            => 'El código postal debe ser numeros',
            'colonia.required'      => 'Escribe alguna colonia',
            'colonia.*.min'           => 'La colonia debe tener mínimo 3 caracteres',
            'colonia.*.max'           => 'La colonia debe tener máximo 50 caracteres',
            'colonia.*.regex'         => 'La colonia debe ser letras sin caracteres especiales',
            'calle.required'        => 'Escribe alguna calle',
            'calle.*.min'             => 'La calle debe tener mínimo 3 caracteres',
            'calle.*.max'             => 'La calle debe tener máximo 50 caracteres',
            'calle.*.regex'           => 'La calle debe ser letras sin caracteres especiales',
            'n_exterior.*.max'        => 'El número exterior no debe ser mayor a 2000',
            'n_exterior.*.numeric'    => 'El número exterior debe ser numeros',
            'n_exterior.*.min'        => 'El número exterior debe sey mayor o igual a 0',
            'n_interior.*.min'        => 'El número interior debe sey mayor o igual a 0',
            'n_interior.*.max'        => 'El número interior no debe ser mayor a 2000',
            'n_interior.*.numeric'    => 'El número interior debe ser numeros',
        ];
    }
}
