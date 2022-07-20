<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\DetalleCat;

class ProductosController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $productos = Producto::withTrashed()->get();
                break;
            case 1:
                $productos = Producto::onlyTrashed()->get();
                break;
            case 2:
                $productos = Producto::with(['marcas', 'materiales', 'unidadMedidas', 'categorias'])->whereNull('deleted_at')->get();
                break;
            default:
                $productos = Producto::where('producto', 'like', '%'.$filtro.'%')
                                        ->orWhere('color', 'like', '%'.$filtro.'%')
                                        ->orWhere('talla', 'like', '%'.$filtro.'%')
                                        ->get();
                break;
        }
        return json_encode($productos);
    }
    public function create(Request $request)
    {
        $request->validate([
            'materiale_id'      => 'required',
            'unidad_medida_id'  => 'required',
            'marca_id'          => 'required',
            'cod_barra'         => 'required',
            'producto'          => 'required',
            'pre_compra'        => 'required',
            'pre_venta'         => 'required',
            'pre_mayoreo'       => 'required',
            'stock_min'         => 'required',
            'stock'             => 'required',
            'afecta_ventas'     => 'required',
        ]);
        $ruta = 'img/productos/';
        $data = $request->all();
        $data['utilidad'] = $data['pre_venta'] - $data['pre_compra'];
        if(Producto::where('cod_barra', $data['cod_barra'])->exists())
        {
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El codigo de barras ya ha registrado']);
        }else{
            try {
                //subir imagen 1
                if($imagen1 = $request->file('img1')){
                    $nomImg = date('YmdHis'). "-img1." . $imagen1->getClientOriginalExtension();//asignamos el nombre a la imagen
                    $imagen1->move($ruta, $nomImg);//hace la subida de la imagen al servidor
                    $data['img1'] = "$nomImg";//pasamo el nombre de l aimagen al indice img
                }else{
                    unset($data['img1']);//eliminamos el indice img1
                }
                //subir imagen 2
                if($imagen2 = $request->file('img2')){
                    $nomImg = date('YmdHis'). "-img2." . $imagen2->getClientOriginalExtension();//asignamos el nombre a la imagen
                    $imagen2->move($ruta, $nomImg);//hace la subida de la imagen al servidor
                    $data['img2'] = "$nomImg";//pasamo el nombre de l aimagen al indice img
                }else{
                    unset($data['img2']);//eliminamos el indice img2
                }
                //subir imagen 3
                if($imagen3 = $request->file('img3')){
                    $nomImg = date('YmdHis'). "-img3." . $imagen3->getClientOriginalExtension();//asignamos el nombre a la imagen
                    $imagen3->move($ruta, $nomImg);//hace la subida de la imagen al servidor
                    $data['img3'] = "$nomImg";//pasamo el nombre de l aimagen al indice img
                }else{
                    unset($data['img3']);//eliminamos el indice img3
                }
                DB::beginTransaction();
                $newProducto = Producto::create($data);
                $producto_id = $newProducto->id;
                for($i=0; $i<sizeof($data['categoria_id']); $i++)
                {
                    $newDetalleCat = new DetalleCat;
                    $newDetalleCat->categoria_id = $data['categoria_id'][$i];
                    $newDetalleCat->producto_id = $producto_id;
                    $newDetalleCat->save();
                }
                DB::commit();
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Producto registrado']);
            } catch (\Exception $e) {
                DB::rollback();
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el producto no fue registrado']);
            }
        }
    }
    public function update(Request $request)
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
