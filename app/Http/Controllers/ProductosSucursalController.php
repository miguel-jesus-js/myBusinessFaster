<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductosSucursalRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\ProductosSucursal;

class ProductosSucursalController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        $sucursal = $request->get('sucursal');
        $isAdmin = Auth::user()->isAdmin;
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $productos = ProductosSucursal::with(['sucursales', 'productos'])->withTrashed()->producto($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
            case 1:
                $productos = ProductosSucursal::with(['sucursales', 'productos'])->onlyTrashed()->producto($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
            case 2:
                $productos = ProductosSucursal::with(['sucursales', 'productos'])->whereNull('productos_sucursal.deleted_at')->producto($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
        }
        return json_encode($productos);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        if(!Auth::user()->isAdmin)
        {
            $data = array_merge($data, ['sucursale_id' => Auth::user()->sucursal->id]);
        }
        try{
            foreach(json_decode($data['productos']) as $producto)
            {
                $producto->sucursale_id = $data['sucursale_id'];
                ProductosSucursal::create(get_object_vars($producto));
            }
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Productos asignados']);
        } catch(\Exception $e){
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los productos no fueron asignados']);
        }
    }
    public function update(Request $request)
    {
        $data = $request->all();
        if(!Auth::user()->isAdmin)
        {
            $data = array_merge($data, ['sucursale_id' => Auth::user()->sucursal->id]);
        }
        $prosductoSucursal = ProductosSucursal::find($data['id']);
        try{
            $producto = json_decode($data['productos']);
            $fila = ['sucursale_id' => $data['sucursale_id'], 'stock' => $producto[0]->stock];
            $prosductoSucursal->update($fila);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            ProductosSucursal::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Producto eliminado de la sucursal']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el producto no fue eliminado']);
        }
    }
    public function getProductos($sucursal_id)
    {
        if(!Auth::user()->isAdmin)
        {
            $sucursal_id = Auth::user()->sucursal->id;
        }
        $productos = Producto::with(['marcas', 'almacenes', 'unidadMedidas', 'proveedores', 'materiales',  'categorias', 'caracteristicas'])
                                ->whereDoesntHave('productosSucursal', function($query) use ($sucursal_id){
                                    $query->where('sucursale_id', $sucursal_id)->whereNull('deleted_at');
                                })->get();
        return json_encode($productos);
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_almacenes.xlsx');
        return response()->file($file);
    }
    public function uploadAlmacen(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
            Excel::import(new AlmacenesImport, $file);
            return json_encode(['icon' => 'success', 'title' => 'Exitó', 'text' => 'Almacenes registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon' => 'error', 'title' => 'Error', 'text' => 'Ocurrio un error, los almacenes no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $almacenes = Almacene::all();
        $pdf = Pdf::loadView('pdf.almacenes_pdf', ['almacenes' => $almacenes, 'esExcel' => false]);
        return $pdf->download('Almacenes.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new AlmacenesExport, 'Almacenes.xlsx');
    }
}
