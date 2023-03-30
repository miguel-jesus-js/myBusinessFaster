<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosRequest extends FormRequest
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
            'tipo_gasto_id' => 'required|numeric|exists:marcas,id',
            'monto'         => 'required|min:1|max:1000000|numeric',
            'desc'          => 'nullable|min:5|max:500|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'comprobante'   => 'nullable|mimes:jpg,jpeg,png|max:5000',
        ];
    }
    public function messages()
    {
        return [
            'tipo_gasto_id.required'    => 'Seleccione un tipo de gasto',
            'tipo_gasto_id.numeric'     => 'El tipo de gasto debe ser un número',
            'tipo_gasto_id.exists'      => 'El tipo de gasto no coincide con los tipos de gasto de la base de datos',
            'monto.required'            => 'Escribe algún precio de compra',
            'monto.min'                 => 'El precio de compra debe de ser mínimo de $1',
            'monto.max'                 => 'El precio de compra debe de ser máximo de $1,000,000',
            'monto.numeric'             => 'El precio de compra debe ser numeros',
            'comprobante.mimes'         => 'La imagen debe tener un fomato (jpeg, jpg, png)',
            'comprobante.max'           => 'La imagen no debe pesar más de 5MB',
            'desc.min'                  => 'La descripción debe de tener mínimo 5 caracteres',
            'desc.max'                  => 'La descripción debe de tener máximo 500 caracteres',
            'desc.regex'                => 'La descripción debe ser letras sin caracteres especiales',
        ];
    }
}
