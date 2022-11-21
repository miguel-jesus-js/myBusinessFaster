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
            'd-ciudad'            => 'required|array|min:1',
            'd-ciudad.*'          => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'd-estado'            => 'required|array|min:1',
            'd-estado.*'          => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'd-municipio'         => 'required|array|min:1',
            'd-municipio.*'       => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'd-cp'                => 'required|array|min:1',
            'd-cp.*'              => 'required|digits:5|numeric',
            'd-colonia'           => 'required|array|min:1',
            'd-colonia.*'         => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'd-calle'             => 'required|array|min:1',
            'd-calle.*'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'd-n_exterior'        => 'nullable|array|min:1',
            'd-n_exterior.*'      => 'nullable|min:0|max:2000|numeric',
            'd-n_interior'        => 'nullable|array|min:1',
            'd-n_interior.*'      => 'nullable|min:0|max:2000|numeric',
        ];
    }
    public function messages()
    {
        return [
            'd-ciudad.required'       => 'Escribe alguna ciudad',
            'd-ciudad.*.min'            => 'La ciudad debe tener mínimo 3 caracteres',
            'd-ciudad.*.max'            => 'La ciudad debe tener máximo 50 caracteres',
            'd-ciudad.*.regex'          => 'La ciudad debe ser letras sin caracteres especiales',
            'd-estado.required'       => 'Escribe algún estado',
            'd-estado.*.min'            => 'El estado debe tener mínimo 3 caracteres',
            'd-estado.*.max'            => 'El estado debe tener máximo 50 caracteres',
            'd-estado.*.regex'          => 'El estado debe ser letras sin caracteres especiales',
            'd-municipio.required'    => 'Escribe algún municipio',
            'd-municipio.*.min'         => 'El municipio debe tener mínimo 3 caracteres',
            'd-municipio.*.max'         => 'El municipio debe tener máximo 50 caracteres',
            'd-municipio.*.regex'       => 'El municipio debe ser letras sin caracteres especiales',
            'd-cp.required'           => 'Escribe algún código postal',
            'd-cp.*.digits'             => 'El código postal debe tener 5 caracteres',
            'd-cp.*.numeric'            => 'El código postal debe ser numeros',
            'd-colonia.required'      => 'Escribe alguna colonia',
            'd-colonia.*.min'           => 'La colonia debe tener mínimo 3 caracteres',
            'd-colonia.*.max'           => 'La colonia debe tener máximo 50 caracteres',
            'd-colonia.*.regex'         => 'La colonia debe ser letras sin caracteres especiales',
            'd-calle.required'        => 'Escribe alguna calle',
            'd-calle.*.min'             => 'La calle debe tener mínimo 3 caracteres',
            'd-calle.*.max'             => 'La calle debe tener máximo 50 caracteres',
            'd-calle.*.regex'           => 'La calle debe ser letras sin caracteres especiales',
            'd-n_exterior.*.max'        => 'El número exterior no debe ser mayor a 2000',
            'd-n_exterior.*.numeric'    => 'El número exterior debe ser numeros',
            'd-n_exterior.*.min'        => 'El número exterior debe sey mayor o igual a 0',
            'd-n_interior.*.min'        => 'El número interior debe sey mayor o igual a 0',
            'd-n_interior.*.max'        => 'El número interior no debe ser mayor a 2000',
            'd-n_interior.*.numeric'    => 'El número interior debe ser numeros',
        ];
    }
}
