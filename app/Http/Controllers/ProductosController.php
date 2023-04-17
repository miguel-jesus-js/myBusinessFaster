<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProductosRequest;
use App\Http\Requests\ProductosUploadRequest;
use App\Models\Producto;
use App\Models\DetalleCat;
use App\Models\Caracteristica;
use App\Models\ImagenesProducto;
use App\Imports\ProductosImport;
use App\Exports\ProductosExport;
use App\Traits\ImagesTrait;
use Illuminate\Support\Facades\Auth;
use PDF;

class ProductosController extends Controller
{
    use ImagesTrait;
    public function index(Request $request, $tipo)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        $marca          = $request->get('f-marca_id');
        $almacen        = $request->get('f-almacene_id');
        $unidadMedida   = $request->get('f-unidad_medida_id');
        $proveedor      = $request->get('f-proveedore_id');
        $material       = $request->get('f-materiale_id');
        $codBarra       = $request->get('f-cod_barra');
        $codSat         = $request->get('f-cod_sat');
        $producto       = $request->get('producto');
        $stock          = $request->get('f-stock');
        $precioMin      = $request->get('f-precio_min');
        $precioMax      = $request->get('f-precio_max');
        $afectaVentas   = $request->get('f-afecta_ventas');
        $esProduccion   = $request->get('f-es_produccion');
        
        $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias', 'caracteristicas'])
                    ->withOrOnlyTrashed($tipo)
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
        return json_encode($productos);
    }
    public function create(ProductosRequest $request)
    {
        
        $data = $request->all();
        try {
            DB::beginTransaction();
            $newProducto = Producto::create($data);
            $imagenes = $request->file('img');
            if(isset($imagenes)){
                foreach($imagenes as $imagen){
                    $nomImg = uniqid().'.'.$imagen->getClientOriginalExtension();
                    $imagen->move('img/productos/', $nomImg);
                    $dataImgProducto = ['producto_id' => $newProducto->id, 'imagen' => $nomImg];
                    ImagenesProducto::create($dataImgProducto);
                }
            }
            $producto_id = $newProducto->id;
            if(isset($data['categoria_id']))
            {
                for($i=0; $i < sizeof($data['categoria_id']); $i++)
                {
                    $datos = ['categoria_id' => $data['categoria_id'][$i], 'producto_id' => $producto_id];
                    DetalleCat::create($datos);
                }
            }
            if(isset($data['caracteristica']))
            {
                for($i=0; $i < sizeof($data['caracteristica']); $i++)
                {
                    $datos = ['caracteristica' => $data['caracteristica'][$i], 'producto_id' => $producto_id];
                    Caracteristica::create($datos);
                }
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Producto registrado']);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el producto no fue registrado']);
        }
    }
    public function update(ProductosRequest $request)
    {
        $data = $request->all();
        $producto = Producto::find($data['id']);
        try {
            DB::beginTransaction();            
            $data['img1'] = $this->uploadImagen($request->file('img1'), 'img1', 'img/productos/');
            $data['img2'] = $this->uploadImagen($request->file('img2'), 'img2', 'img/productos/');
            $data['img3'] = $this->uploadImagen($request->file('img3'), 'img3', 'img/productos/');
            
            if($data['img1'] == null)
            {
                unset($data['img1']);
            }else{
                $this->deleteImagen('img/productos', $producto->img1);
            }
            if($data['img2'] == null)
            {
                unset($data['img2']);
            }else{
                $this->deleteImagen('img/productos', $producto->img2);
            }
            if($data['img3'] == null)
            {
                unset($data['img3']);
            }else{
                $this->deleteImagen('img/productos', $producto->img3);
            }
            $producto->update($data);
            $producto_id = $producto->id;
            $categorias = json_decode($data['categorias']);
            if(isset($data['categoria_id']))
            {
                for($i=0; $i < sizeof($categorias); $i++)
                {
                    $datos = ['categoria_id' => $categorias[$i]->id, 'producto_id' => $producto_id];
                    if(DetalleCat::where([['categoria_id', $categorias[$i]->id], ['producto_id', $producto_id]])->exists())
                    {
                        if($categorias[$i]->status == false)
                        {
                            DetalleCat::where([['categoria_id', $categorias[$i]->id], ['producto_id', $producto_id]])->delete();
                        }
                    }else{
                        if($categorias[$i]->status == true)
                        {
                            DetalleCat::create($datos);
                        }
                    }
                    
                }
            }
            if(isset($data['caracteristica']))
            {
                for($i=0; $i < sizeof($data['caracteristica']); $i++)
                {
                    $datos = ['caracteristica' => $data['caracteristica'][$i], 'producto_id' => $producto_id];
                    if($data['c-id'][$i] == null)
                    {
                        Caracteristica::create($datos);
                    }else{
                        $caracteristica = Caracteristica::find($data['c-id'][$i]);
                        $caracteristica->update($datos);
                    }
                }
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function show(Request $request, $id)
    {
        $producto = Producto::where('id', $id)->with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias', 'caracteristicas'])->first();
        return view('producto_show')->with('producto', $producto);
    }   
    public function delete($id)
    {
        try {
            Producto::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Producto eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el producto no fue eliminado']);
        }
    }
    public function deleteCaract($id)
    {
        try{
            Caracteristica::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Característica eliminada']);
        }catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la característica no fue eliminada']);
        }
    }
    public function searchProductForSale(Request $request)
    {
        $data = $request->all();
        $sucursalId = Auth::user()->sucursal->id;
        $producto = Producto::whereHas('sucursales', function($query) use ($sucursalId){
            $query->where('sucursale_id', $sucursalId);
        })->with('sucursales')->where('cod_barra', $data['cod_barra_search'])->first();
        return json_encode($producto);
    }
    public function generateCodBarra()
    {   
        $existe = true;
        while($existe)
        {
            $codBarra = random_int(1000000000000, 9999999999999);
            $existe = Producto::where('cod_barra', $codBarra)->exists();
        }
        return $codBarra;
    }
    public function generateCodSat()
    {   
        $existe = true;
        while($existe)
        {
            $codSat = random_int(10000000, 99999999);
            $existe = Producto::where('cod_sat', $codSat)->exists();
        }
        return $codSat;
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_productos.xlsx');
        return response()->file($file);
    }
    public function uploadProducto(ProductosUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new ProductosImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Productos registrados']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los productos no fueron registrados']);
        }
    }
    public function exportarPDF(Request $request)
    {
        $nombreCampos = ['marca_id' => 'Marcas', 'almacene_id' => 'Almacén', 'unidad_medida_id' => 'Unidad de medida', 'proveedore_id' => 'Proveedor', 'materiale_id' => 'Material', 'cod_barra' => 'Código de barra', 'cod_sat' => 'Código del sat', 'producto' => 'Producto', 'pre_compra' => 'Precio de compra', 'pre_venta' => 'Precio de venta', 'pre_mayoreo' => 'Precio de mayoreo', 'utilidad' => 'Utilidad', 'stock_min' => 'Stock mínimo', 'stock' => 'Stock', 'caducidad' => 'Caduidad', 'color' => 'Color', 'talla' => 'Talla', 'modelo' => 'Modelo', 'meses_garantia' => 'Meses de garantía', 'peso_kg' => 'Peso en KG'];
        $marca          = $request->get('f-marca_id');
        $almacen        = $request->get('f-almacene_id');
        $unidadMedida   = $request->get('f-unidad_medida_id');
        $proveedor      = $request->get('f-proveedore_id');
        $material       = $request->get('f-materiale_id');
        $codBarra       = $request->get('f-cod_barra');
        $codSat         = $request->get('f-cod_sat');
        $producto       = $request->get('producto');
        $stock          = $request->get('f-stock');
        $precioMin      = $request->get('f-precio_min');
        $precioMax      = $request->get('f-precio_max');
        $afectaVentas   = $request->get('f-afecta_ventas');
        $esProduccion   = $request->get('f-es_produccion');
        $campos         = $request->get('campos');
        
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
        //view()->share('pdf.productos_pdf', $productos);
        $pdf = Pdf::loadView('pdf.productos_pdf', ['productos' => $productos, 'campos' => $campos, 'nombreCampos' => $nombreCampos, 'esExcel' => false])->setPaper('a4', 'landscape');
        return $pdf->download('Productos.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new ProductosExport, 'Productos.xlsx');
    }
}
