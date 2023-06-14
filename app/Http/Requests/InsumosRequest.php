<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsumosRequest extends FormRequest
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
            'parent_id'         => 'required|numeric|exists:productos_sucursal,producto_id',
            'id'                => 'required|numeric|exists:productos_sucursal,producto_id',
            'cantidad'          => 'required|min:1|max:1000000|numeric',
            'cantidad_producto' => 'required|min:1|max:1000000|numeric',
        ];
    }
    public function messages()
    {
        return [
            'parent_id.required'        => 'Seleccione un producto',
            'parent_id.numeric'         => 'El producto debe ser un número',
            'parent_id.exists'          => 'La marca no coincide con las marcas de la base de datos',
            'cantidad.required'         => 'Escribe la cantidad',
            'cantidad.min'              => 'La cantidad debe de ser mínimo de 1',
            'cantidad.max'              => 'La cantidad debe de ser máximo de 1,000,000',
            'cantidad.numeric'          => 'La cantidad debe ser numeros',
            'cantidad_producto.required'=> 'Escribe la cantidad por producto',
            'cantidad_producto.min'     => 'La cantidad por producto debe de ser mínimo de 1',
            'cantidad_producto.max'     => 'La cantidad por producto debe de ser máximo de 1,000,000',
            'cantidad_producto.numeric' => 'La cantidad por producto debe ser numeros',
        ];
    }
}
