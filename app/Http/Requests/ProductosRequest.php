<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosRequest extends FormRequest
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
        date_default_timezone_set("America/Mexico_City");
        $fechaActual = date('Y-m-d');
        return [
            'marca_id'          => 'required|numeric',
            'almacene_id'       => 'required|numeric',
            'unidad_medida_id'  => 'required|numeric',
            'proveedore_id'     => 'required|numeric',
            'materiale_id'      => 'nullable|numeric',
            'cod_barra'         => 'required|min:13|max:13|regex:/^[0-9a-zA-Z]+$/|unique:productos,cod_barra,'.$this->id,
            'cod_sat'           => 'nullable|min:1|max:99999999|numeric|unique:productos,cod_sat,'.$this->id,
            'producto'          => 'required|min:3|max:50|regex:/^[\sA-Za-zÁÉÍÓÚáéíóúÑñ]{3,50}$/',
            'pre_compra'        => 'required|min:1|max:1000000|numeric',
            'pre_venta'         => 'required|min:1|max:1000000|numeric',
            'pre_mayoreo'       => 'required|min:1|max:1000000|numeric',
            'stock_min'         => 'required|min:1|max:1000000|numeric',
            'stock'             => 'required|min:1|max:1000000|numeric',
            'img1'              => 'nullable|mimes:jpg,jpeg,png|max:5000',
            'img2'              => 'nullable|mimes:jpg,jpeg,png|max:5000',
            'img3'              => 'nullable|mimes:jpg,jpeg,png|max:5000',
            'caducidad'         => 'nullable|date|date_format:Y-m-d|after:'.$fechaActual,
            'color'             => 'nullable|min:3|max:50|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'talla'             => 'nullable|min:1|max:15|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'modelo'            => 'nullable|min:3|max:50|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'meses_garantia'    => 'nullable|min:0|max:36|numeric',
            'peso_kg'           => 'nullable|min:0|max:500|numeric',
            'desc_detallada'    => 'nullable|min:5|max:200|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
            'es_produccion'     => 'nullable|min:0|max:1|numeric',
            'afecta_ventas'     => 'nullable|min:0|max:1|numeric',
        ];
    }
    public function messages()
    {
        return [
            'marca_id.required'         => 'Seleccione una marca',
            'marca_id.numeric'          => 'La marca debe ser un número',
            'almacene_id.required'      => 'Seleccione un almacén',
            'almacene_id.numeric'       => 'El almacén debe ser un número',
            'unidad_medida_id.required' => 'Seleccione una unidad de medida',
            'unidad_medida_id.numeric'  => 'La unidad de medida debe ser un número',
            'proveedore_id.required'    => 'Seleccione un proveedor',
            'proveedore_id.numeric'     => 'El proveedor debe ser un número',
            'materiale_id.numeric'      => 'El material debe ser un número',
            'cod_barra.required'        => 'Escribe algún código de barra',
            'cod_barra.min'             => 'El código de barra debe de tener mínimo 13 dígitos',
            'cod_barra.max'             => 'El código de barra debe de tener máximo 13 dígitos',
            'cod_barra.regex'           => 'El código de barra debe ser numeros y/o letras sin caracteres especiales',
            'cod_barra.unique'          => 'El código de barra ya existe',
            'cod_sat.min'               => 'El código del SAT debe de tener mínimo 8 dígitos',
            'cod_sat.max'               => 'El código del SAT debe de tener máximo 8 dígitos',
            'cod_sat.numeric'           => 'El código del SAT debe ser numeros',
            'cod_sat.unique'            => 'El código del SAT ya existe',
            'producto.required'         => 'Escribe algún producto',
            'producto.min'              => 'El producto debe de tener mínimo 3 caracteres',
            'producto.max'              => 'El producto debe de tener máximo 50 caracteres',
            'producto.regex'            => 'El producto debe ser letras sin caracteres especiales',
            'pre_compra.required'       => 'Escribe algún precio de compra',
            'pre_compra.min'            => 'El precio de compra debe de ser mínimo de $1',
            'pre_compra.max'            => 'El precio de compra debe de ser máximo de $1,000,000',
            'pre_compra.numeric'        => 'El precio de compra debe ser numeros',
            'pre_venta.required'        => 'Escribe algún precio de venta',
            'pre_venta.min'             => 'El precio de venta debe de ser mínimo de $1',
            'pre_venta.max'             => 'El precio de venta debe de ser máximo de $1,000,000',
            'pre_venta.numeric'         => 'El precio de venta debe ser numeros',
            'pre_mayoreo.required'      => 'Escribe algún precio de mayoreo',
            'pre_mayoreo.min'           => 'El precio de mayoreo debe de ser mínimo de $1',
            'pre_mayoreo.max'           => 'El precio de mayoreo debe de ser máximo de $1,000,000',
            'pre_mayoreo.numeric'       => 'El precio de mayoreo debe ser numeros',
            'stock_min.required'        => 'Escribe el stock minimo',
            'stock_min.min'             => 'El stock minimo debe de ser mínimo de 1',
            'stock_min.max'             => 'El stock minimo debe de ser máximo de 1,000,000',
            'stock_min.numeric'         => 'El stock minimo debe ser numeros',
            'stock.required'            => 'Escribe el stock',
            'stock.min'                 => 'El stock debe de ser mínimo de 1',
            'stock.max'                 => 'El stock debe de ser máximo de 1,000,000',
            'stock.numeric'             => 'El stock debe ser numeros',
            'img1.mimes'                => 'La imagen debe tener un fomato (jpeg, jpg, png)',
            'img1.max'                  => 'La imagen no debe pesar más de 5MB',
            'img2.mimes'                => 'La imagen debe tener un fomato (jpeg, jpg, png)',
            'img2.max'                  => 'La imagen no debe pesar más de 5MB',
            'img3.mimes'                => 'La imagen debe tener un fomato (jpeg, jpg, png)',
            'img3.max'                  => 'La imagen no debe pesar más de 5MB',
            'caducidad.date'            => 'La fecha de caducidad debe ser una fecha',
            'caducidad.date_format'     => 'La fecha de caducidad debe tener un formato año-mes-dia',
            'caducidad.after'           => 'La fecha de caducidad debe ser mayor a la fecha actual',
            'color.min'                 => 'El color debe de tener mínimo 3 caracteres',
            'color.max'                 => 'El color debe de tener máximo 50 caracteres',
            'color.regex'               => 'El color debe ser letras sin especiales',
            'talla.min'                 => 'La talla debe de tener mínimo 1 carácter',
            'talla.max'                 => 'La talla debe de tener máximo 15 caracteres',
            'talla.regex'               => 'La talla debe ser letras sin especiales',
            'modelo.min'                => 'El modelo debe de tener mínimo 3 caracteres',
            'modelo.max'                => 'El modelo debe de tener máximo 50 caracteres',
            'modelo.regex'              => 'El modelo debe ser letras sin caracteres especiales',
            'meses_garantia.min'        => 'Los meses de garantía deben de ser mayor o igual a 0',
            'meses_garantia.max'        => 'Los meses de garantía debe de ser máximo de 36',
            'meses_garantia.numeric'    => 'Los meses de garantía debe de ser numeros',
            'peso_kg.min'               => 'El peso en KG deben de ser mayor o igual a 0',
            'peso_kg.max'               => 'El peso en KG debe de ser máximo de 500',
            'peso_kg.numeric'           => 'El peso en KG debe de ser numeros',
            'desc_detallada.min'        => 'La descripción detallada debe de tener mínimo 5 caracteres',
            'desc_detallada.max'        => 'La descripción detallada debe de tener máximo 200 caracteres',
            'desc_detallada.regex'      => 'La descripción detallada debe ser letras sin caracteres especiales',
            'es_produccion.min'         => 'La casilla es producción debe estar marcada o desmarcada',
            'es_produccion.max'         => 'La casilla es producción debe estar marcada o desmarcada',
            'es_produccion.numeric'     => 'La casilla es producción debe estar marcada o desmarcada',
            'afecta_ventas.min'         => 'La casilla afecta ventas debe estar marcada o desmarcada',
            'afecta_ventas.max'         => 'La casilla afecta ventas debe estar marcada o desmarcada',
            'afecta_ventas.numeric'     => 'La casilla afecta ventas debe estar marcada o desmarcada',
        ];
    }
}
