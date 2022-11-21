<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Requests\ProductosRequest;
use App\Models\Producto;
use App\Models\DetalleCat;

class ProductosController extends Controller
{
    public function uploadImagen($imagen, $numImagen)
    {
        if($imagen != null)
        {
            $ruta = 'img/productos/';
            $nomImg = date('YmdHis'). '-'.$numImagen.'.' . $imagen->getClientOriginalExtension();//asignamos el nombre a la imagen
            $imagen->move($ruta, $nomImg);//hace la subida de la imagen al servidor
            return $nomImg;
        }
        return null;
    }
    public function index(Request $request, $tipo)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        $filtro = $request->get('filtro');
        switch ($tipo){
            case 0:
                $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias'])
                                        ->withTrashed()
                                        ->producto($filtro)
                                        ->get();
                break;
            case 1:
                $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias'])
                                        ->onlyTrashed()
                                        ->producto($filtro)
                                        ->get();
                break;
            case 2:
                $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias'])
                                        ->whereNull('deleted_at')
                                        ->producto($filtro)
                                        ->get();
                break;
            default:
                $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias'])
                                        ->where('producto', 'like', '%'.$filtro.'%')
                                        ->orWhere('color', 'like', '%'.$filtro.'%')
                                        ->orWhere('talla', 'like', '%'.$filtro.'%')
                                        ->get();
                break;
        }
        return json_encode($productos);
    }
    public function create(ProductosRequest $request)
    {
        
        $data = $request->all();
        $data['utilidad'] = $data['pre_venta'] - $data['pre_compra'];
        try {
            DB::beginTransaction();
            $data['img1'] = $this->uploadImagen($request->file('img1'), 'img1');
            $data['img2'] = $this->uploadImagen($request->file('img2'), 'img2');
            $data['img3'] = $this->uploadImagen($request->file('img3'), 'img3');
            $newProducto = Producto::create($data);
            $producto_id = $newProducto->id;
            if(isset($data['categoria_id']))
            {
                for($i=0; $i < sizeof($data['categoria_id']); $i++)
                {
                    $datos = ['categoria_id' => $data['categoria_id'][$i], 'producto_id' => $producto_id];
                    DetalleCat::create($datos);
                }
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Producto registrado']);
        } catch (\Exception $e) {
            DB::rollback();
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el producto no fue registrado']);
        }
    }
    public function update(ProductosRequest $request)
    {
        $request->validate([
            'id'          => 'required',
            'marca'       => 'required',
        ]);
        $marcas = Marca::find($request->all()['id']);
        $data = $request->all();
        try {
            $marcas->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Marca::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marca eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la marca no fue eliminada']);
        }
    }
}
