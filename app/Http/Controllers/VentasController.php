<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Detalle;
use App\Models\Configuracione;
use App\Models\ProductosSucursal;
use App\Models\User;
use App\Models\Cliente;
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

        $ventas         = Venta::with(['sucursal', 'cliente', 'empleado.persona', 'cliente.persona'])
                            ->folio($folio)
                            ->sucursal($sucursale_id)
                            ->empleado($user_id)
                            ->cliente($cliente_id)
                            ->fechaIni($fecha_ini)
                            ->fechaFin($fecha_fin)
                            ->offset($offset)
                            ->limit($limit)
                            ->get();
        $cantidad       = Venta::with(['sucursal', 'cliente'])
                            ->folio($folio)
                            ->sucursal($sucursale_id)
                            ->empleado($user_id)
                            ->cliente($cliente_id)
                            ->fechaIni($fecha_ini)
                            ->fechaFin($fecha_fin)
                            ->count();
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
                'cliente_id'    => isset($data['cliente_id']) ? $data['cliente_id'] : null,
                'sucursale_id'  => Auth::user()->sucursal->id,
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
                    'importe'   => floatval($producto->precio) * intval($producto->cantidad),
                    'created_at'=> $fecha,
                    'updated_at'=> $fecha,
                ];
                $venta->productos()->attach($producto->producto_id, $datos_detalle);
                $cantidadActual = ProductosSucursal::where([['sucursale_id', Auth::user()->sucursal->id], ['producto_id', $producto->producto_id]])->first();
                $newCantidad = intval($cantidadActual->stock) - intval($producto->cantidad);
                $cantidadActual->update(['stock' => $newCantidad]);
            }
            DB::commit();
            // $venta_detalle = Venta::with(['productos','empleado.sucursal', 'cliente'])->find($venta->id);
            // $setting = Configuracione::find(1);
            return json_encode([
                'icon'          => 'success', 
                'title'         => 'Exitó', 
                'text'          => 'Venta Realizada', 
                'venta_id'      => $venta->id,
            ]);
        }catch(\Exception $e){
            DB::rollback();
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la venta no fue registrada']);
        }
    }
    public function puntoVenta(){
        $settings = Configuracione::find(1);
        return view('punto_venta', ['settings' => $settings]);
    }
    public function dashboard()
    {
        $sucursal           = Auth::user()->sucursal->id;
        $fecha = Carbon::now()->format('Y-m-d');
        $ventas_totales     = Venta::betwwenDate()->sum('total');
        $productos_v_t      = Detalle::whereBetween('created_at', [$fecha.' 00:00:00', $fecha.' 23:59:59'])->count();
        //obtener la cantidad de ventas, productos, empleados y clientes por sucursal y en general
        $ventas_t           = Venta::betwwenDate()->count();
        $ventas_s_t         = Venta::betwwenDate()->sucursal($sucursal)->count();
        $productos_t_v      = Producto::count();
        $productos_s_t      = ProductosSucursal::sucursal($sucursal)->count();
        $empleados_t        = User::count();
        $empleados_s_t      = User::userSucursal($sucursal)->count();
        $clientes_t         = Cliente::count();
        //obtener los productos vendidos
        $productos_t        = Detalle::with('producto')
                                        ->whereBetween('created_at', [$fecha.' 00:00:00', $fecha.' 23:59:59'])
                                        ->selectRaw('producto_id, precio, sum(cantidad) as total_cantidad')
                                        ->groupBy('producto_id', 'precio')
                                        ->get();
        //obtener ventas por sucursal
        $fecha_ayer = Carbon::now()->subDay()->format('Y-m-d');
        $ventas_by_sucursal = Venta::leftJoin('sucursales', 'ventas.sucursale_id', '=', 'sucursales.id')
                                    ->selectRaw('sum(case when fecha BETWEEN ? AND ? then total end) as total_ayer, 
                                    sum(case when fecha BETWEEN ? AND ? then total end) as total_hoy, 
                                    sucursales.nombre')
                                    ->groupBy('sucursale_id')
                                    ->setBindings([$fecha_ayer.' 00:00:00', $fecha_ayer.' 23:59:59', $fecha.' 00:00:00', $fecha.' 23:59:59'])
                                    ->get();

        return view('dashboard', [
            'ventas_totales'    => $ventas_totales, 
            'productos_v_t'     => $productos_v_t,
            'productos_t'       => $productos_t,
            'ventas_by_sucursal'=> $ventas_by_sucursal,
            'totales'           => [
                $ventas_t,
                $ventas_s_t,
                $productos_t_v,
                $productos_s_t,
                $empleados_t,
                $empleados_s_t,
                $clientes_t
            ],
        ]);
    }
    public function saleByEmployees(Request $request)
    {
        $sucursal_id    = $request->get('sucursale_id');
        $fecha          = Carbon::now()->format('Y-m-d');
        $fecha_ini      = $fecha.' 00:00:00';
        $fecha_fin      = $fecha.' 23:59:59';
        $saleByEmployees_t = User::with(['sucursal', 'persona'])->selectRaw('*, (select sum(ventas.total) from ventas where users.id = ventas.user_id and ventas.fecha between ? and ?) as ventas_sum_total', [$fecha_ini, $fecha_fin])
                                    ->whereHas('ventas', function($query) use ($fecha_ini, $fecha_fin){
                                        $query->whereBetween('fecha', [$fecha_ini, $fecha_fin]);
                                    })
                                    ->userSucursal($sucursal_id)
                                    ->get();
        $ammount = User::with(['sucursal', 'persona'])->selectRaw('*, (select sum(ventas.total) from ventas where users.id = ventas.user_id and ventas.fecha between ? and ?) as ventas_sum_total', [$fecha_ini, $fecha_fin])
                                    ->whereHas('ventas', function($query) use ($fecha_ini, $fecha_fin){
                                        $query->whereBetween('fecha', [$fecha_ini, $fecha_fin]);
                                    })
                                    ->userSucursal($sucursal_id)
                                    ->count();
        return json_encode([$saleByEmployees_t, $ammount]);
    }
    public function show($id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente', 'sucursal'])->find($id);
        $setting = Configuracione::find(1);
        return view('detalle', ['venta' => $venta, 'setting' => $setting]);
    }
    public function print($id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente', 'sucursal'])->find($id);
        $setting = Configuracione::find(1);
        return view('print.detalle', ['venta' => $venta, 'setting' => $setting, 'isTicket' => true]);
        // $pdf = Pdf::loadView('print.detalle', ['venta' => $venta, 'setting' => $setting]);
        // return $pdf->download('Detalle de venta');
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
