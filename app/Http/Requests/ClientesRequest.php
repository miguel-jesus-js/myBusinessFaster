<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientesRequest extends FormRequest
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
            'tipo_cliente_id'   => 'required|numeric|exists:tipo_clientes,id',
            'empresa'           => 'nullable|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'limite_credito'    => 'nullable|min:0|max:1000000|numeric',
            'dias_credito'      => 'nullable|min:0|max:200|numeric',
        ];
    }
    public function messages()
    {
        return [
            'tipo_cliente_id.required' => 'Seleccione un tipo de cliente',
            'tipo_cliente_id.numeric'  => 'El tipo de cliente debe ser un número',
            'tipo_cliente_id.exists'   => 'El tipo de cliente no coincide con los tipos de clientes de la base de datos',
            'empresa.min'           => 'La empresa debe tener mínimo 3 caracteres',
            'empresa.max'           => 'La empresa debe tener máximo 50 caracteres',
            'empresa.regex'         => 'La empresa debe ser letras sin caracteres especiales',
            'limite_credito.min'    => 'El límite de crédito debe ser mayor o igual a 0',
            'limite_credito.max'    => 'El límite de crédito no debe ser mayor a 1000000',
            'limite_credito.numeric'=> 'El límite de crédito debe ser numeros',
            'dias_credito.min'      => 'Los dias de crédito deben ser mayor o igual a 0 dias',
            'dias_credito.max'      => 'Los dias de crédito deben tener máximo 2000 dias',
            'dias_credito.numeric'  => 'Los dias de crédito deben ser numeros',
        ];
    }
}
