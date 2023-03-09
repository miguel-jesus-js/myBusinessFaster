<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle;
use App\Models\Configuracione;
use App\Models\ProductosSucursal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;


class VentasController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $folio          = $request->get('folio');
        $sucursale_id   = $request->get('sucursale_id');
        $user_id        = $request->get('user_id');
        $cliente_id     = $request->get('cliente_id');
        $fecha_ini      = $request->get('fecha_ini');
        $fecha_fin      = $request->get('fecha_fin');
        $offset         = $request->get('offset');
        $limit          = $request->get('limit');

        $ventas         = Venta::with(['empleado.sucursal', 'cliente'])
                            ->folio($folio)
                            ->sucursal($sucursale_id)
                            ->empleado($user_id)
                            ->cliente($cliente_id)
                            ->fechaIni($fecha_ini)
                            ->fechaFin($fecha_fin)
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
        $cantidad       = Venta::count();
        return json_encode([$ventas, $cantidad]);
    }
    public function create(Request $request)
    {
        $data = $request->all();
        try{
            DB::beginTransaction();
            $folio = Venta::orderBy('id', 'desc')->first();
            $fecha = Carbon::now()->format('Y-m-d H:i:s');
            $carrito = json_decode($data['carrito']);
            $datos_venta = [
                'user_id'       => Auth::user()->id, 
                'cliente_id'    => $data['cliente_id'], 
                'folio'         => $folio == null ? 1 : $folio->folio + 1, 
                'fecha'         => $fecha, 
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
    public function dashboard()
    {
        $sucursal = Auth::user()->sucursal->id;
        $fecha = Carbon::now()->format('Y-m-d');
        $ventas_totales = Venta::whereBetween('fecha', [$fecha.' 00:00:00', $fecha.' 23:59:59'])->sum('total');
        $mis_ventas_t = Venta::whereBetween('fecha', [$fecha.' 00:00:00', $fecha.' 23:59:59'])->sucursal($sucursal)->sum('total');
        return view('dashboard', ['ventas_totales' => $ventas_totales, 'mis_ventas_t' => $mis_ventas_t]);
    }
    public function saleByEmployees($sucursal)
    {
        $fecha = Carbon::now()->format('Y-m-d');
        $saleByEmployees_t = Venta::whereBetween('fecha', [$fecha.' 00:00:00', $fecha.' 23:59:59'])->sucursal($sucursal)->groupBy('user_id')->sum('total');
        return json_encode($saleByEmployees_t);
    }
    public function show($id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente'])->find($id);
        $setting = Configuracione::find(1);
        return view('detalle', ['venta' => $venta, 'setting' => $setting]);
    }
    public function print($id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente'])->find($id);
        $setting = Configuracione::find(1);
        $pdf = Pdf::loadView('print.detalle', ['venta' => $venta, 'setting' => $setting]);
        return $pdf->output();
    }
    public function delete($id)
    {
        try {
            Venta::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Venta eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la venta no fue eliminada']);
        }
    }
}
