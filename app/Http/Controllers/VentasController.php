<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle;
use App\Models\ProductosSucursal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class VentasController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->all();
        $producto = Producto::where('cod_barra', $data['cod_barra_search'])->first();
        return json_encode($producto);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        try{
            DB::beginTransaction();
            $folio = Venta::orderBy('id', 'desc')->first();
            $fecha = Carbon::now();
            $carrito = json_decode($data['carrito']);
            $datos_venta = [
                'user_id'       => Auth::user()->id, 
                'cliente_id'    => $data['cliente_id'], 
                'folio'         => $folio == null ? 1 : $folio->folio + 1, 
                'fecha'         => '2023-01-21 00:20:51', 
                'importe'       => floatval($data['subtotal']), 
                'iva'           => floatval($data['iva']),
                'descuento'     => floatval($data['descuento']),
                'total'         => (floatval($data['subtotal']) + floatval($data['iva'])) - floatval($data['descuento']),
                'paga_con'      => floatval($data['paga_con']),
                'tipo_pago'     => 'Efectivo',
                'estado'        => 1,
            ];
            $venta = Venta::create($datos_venta);
            foreach($carrito as $producto)
            {
                $datos_detalle = [
                    'precio'    => floatval($producto->precio),
                    'cantidad'  => intval($producto->cantidad),
                    'importe'   => floatval($producto->precio) * intval($producto->cantidad)
                ];
                $venta->productos()->attach($producto->producto_id, $datos_detalle);
                $cantidadActual = ProductosSucursal::where([['sucursale_id', Auth::user()->sucursal->id], ['producto_id', $producto->producto_id]])->first();
                $newCantidad = intval($cantidadActual->stock) - intval($producto->cantidad);
                $cantidadActual->update(['stock' => $newCantidad]);
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Venta Realizada']);
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la venta no fue registrada']);
        }
    }
}
