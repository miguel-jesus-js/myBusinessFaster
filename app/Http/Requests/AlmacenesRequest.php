<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmacenesRequest extends FormRequest
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
        $rules = [
            'nombre'        => 'required|min:5|max:20|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'desc'          => 'required|min:3|max:200|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
        ];
        if($this->user()->isAdmin)
        {
            $rules['sucursale_id']  = 'required|numeric|exists:sucursales,id';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'sucursale_id.required' => 'Seleccione una sucursal',
            'sucursale_id.numeric'  => 'La sucursal debe ser un número',
            'sucursale_id.exists'   => 'La sucursal no coincide con las sucursales de la base de datos',
            'nombre.required'       => 'Escribe algún almacén',
            'nombre.min'            => 'El almacén debe tener mínimo 5 caracteres',
            'nombre.max'            => 'El almacén debe tener máximo 20 caracteres',
            'nombre.regex'          => 'El almacén debe ser letras sin caracteres especiales',
            'desc.required'         => 'Escribe alguna descripción',
            'desc.min'              => 'La descripción debe tener mínimo 5 caracteres',
            'desc.max'              => 'La descripción debe tener máximo 200 caracteres',
            'desc.regex'            => 'La descripción debe ser letras sin caracteres especiales',
        ];
    }
}
