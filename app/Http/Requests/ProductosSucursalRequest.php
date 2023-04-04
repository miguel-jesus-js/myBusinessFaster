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
            'pre_compra.*'    => 'required|min:1|max:1000000|numeric',
            'pre_venta.*'     => 'required|min:1|max:1000000|numeric',
            'pre_mayoreo.*'   => 'required|min:1|max:1000000|numeric',
            'stock.*'         => 'required|min:1|max:1000000|numeric',
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
            'pre_compra.*.required'   => 'Escribe algún precio de compra',
            'pre_compra.*.min'        => 'El precio de compra debe de ser mínimo de $1',
            'pre_compra.*.max'        => 'El precio de compra debe de ser máximo de $1,000,000',
            'pre_compra.*.numeric'    => 'El precio de compra debe ser numeros',
            'pre_venta.*.required'    => 'Escribe algún precio de venta',
            'pre_venta.*.min'         => 'El precio de venta debe de ser mínimo de $1',
            'pre_venta.*.max'         => 'El precio de venta debe de ser máximo de $1,000,000',
            'pre_venta.*.numeric'     => 'El precio de venta debe ser numeros',
            'pre_mayoreo.*.required'  => 'Escribe algún precio de mayoreo',
            'pre_mayoreo.*.min'       => 'El precio de mayoreo debe de ser mínimo de $1',
            'pre_mayoreo.*.max'       => 'El precio de mayoreo debe de ser máximo de $1,000,000',
            'pre_mayoreo.*.numeric'   => 'El precio de mayoreo debe ser numeros',
            'stock.*.required'        => 'Escribe el stock',
            'stock.*.min'             => 'El stock debe de ser mínimo de 1',
            'stock.*.max'             => 'El stock debe de ser máximo de 1,000,000',
            'stock.*.numeric'         => 'El stock debe ser numeros',
        ];
    }
}
