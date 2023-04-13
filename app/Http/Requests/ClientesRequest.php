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
            'tipo_cliente_id'   => 'required|numeric',
            'nombres'           => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'email'             => 'required|min:10|max:50|email|unique:clientes,email,'.$this->id,
            'telefono'          => 'required|min:14|max:14|unique:clientes,telefono,'.$this->id,
            'rfc'               => 'nullable|min:3|max:50|regex:/^([a-z]{3,4})(\d{2})(\d{2})(\d{2})([0-9a-z]{3})$/i|unique:clientes,rfc,'.$this->id,
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
