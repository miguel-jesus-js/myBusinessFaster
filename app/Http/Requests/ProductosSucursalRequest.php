<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosSucursalRequest extends FormRequest
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
            'stock' => 'required|min:1|max:1000000|numeric',
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
            'stock.required'        => 'Escribe el stock',
            'stock.min'             => 'El stock debe de ser mínimo de 1',
            'stock.max'             => 'El stock debe de ser máximo de 1,000,000',
            'stock.numeric'         => 'El stock debe ser numeros',
        ];
    }
}
