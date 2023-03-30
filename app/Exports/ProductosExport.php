<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\Producto;

class ProductosExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view() : View
    {
        $nombreCampos = ['marca_id' => 'Marcas', 'almacene_id' => 'Almacén', 'unidad_medida_id' => 'Unidad de medida', 'proveedore_id' => 'Proveedor', 'materiale_id' => 'Material', 'cod_barra' => 'Código de barra', 'cod_sat' => 'Código del sat', 'producto' => 'Producto', 'pre_compra' => 'Precio de compra', 'pre_venta' => 'Precio de venta', 'pre_mayoreo' => 'Precio de mayoreo', 'utilidad' => 'Utilidad', 'stock_min' => 'Stock mínimo', 'stock' => 'Stock', 'caducidad' => 'Caduidad', 'color' => 'Color', 'talla' => 'Talla', 'modelo' => 'Modelo', 'meses_garantia' => 'Meses de garantía', 'peso_kg' => 'Peso en KG'];
        $marca          = request()->get('f-marca_id');
        $almacen        = request()->get('f-almacene_id');
        $unidadMedida   = request()->get('f-unidad_medida_id');
        $proveedor      = request()->get('f-proveedore_id');
        $material       = request()->get('f-materiale_id');
        $codBarra       = request()->get('f-cod_barra');
        $codSat         = request()->get('f-cod_sat');
        $producto       = request()->get('producto');
        $stock          = request()->get('f-stock');
        $precioMin      = request()->get('f-precio_min');
        $precioMax      = request()->get('f-precio_max');
        $afectaVentas   = request()->get('f-afecta_ventas');
        $esProduccion   = request()->get('f-es_produccion');
        $formato        = request()->get('formato');
        $campos         = request()->get('campos');
        
        $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias', 'caracteristicas'])
                    ->marca($marca)
                    ->almacen($almacen)
                    ->unidadMedida($unidadMedida)
                    ->proveedor($proveedor)
                    ->material($material)
                    ->codBarra($codBarra)
                    ->codSat($codSat)
                    ->stock($stock)
                    ->precioMin($precioMin)
                    ->precioMax($precioMax)
                    ->afectaVentas($afectaVentas)
                    ->esProduccion($esProduccion)
                    ->producto($producto)
                    ->get();
        return view('pdf.productos_pdf', [
            'productos'     => $productos, 
            'campos'        => $campos, 
            'nombreCampos'  => $nombreCampos,
            'esExcel' => true,
        ]);
    }
}
