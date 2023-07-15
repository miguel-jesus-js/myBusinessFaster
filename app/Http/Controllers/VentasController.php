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
use App\Models\Pago;
use App\Models\Inventario;
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
        $estado         = $request->get('estado');
        $tipo           = $request->get('tipo');

        $ventas         = Venta::with(['sucursal', 'cliente', 'empleado.persona', 'cliente.persona'])
                            ->folio($folio)
                            ->sucursal($sucursale_id)
                            ->empleado($user_id)
                            ->cliente($cliente_id)
                            ->fechaIni($fecha_ini)
                            ->fechaFin($fecha_fin)
                            ->offset($offset)
                            ->limit($limit)
                            ->where('tipo', $tipo)
                            ->when($estado == 1, function($query){
                                return $query->where('estado', 1);
                            })
                            ->get();
        $cantidad       = Venta::with(['sucursal', 'cliente'])
                            ->folio($folio)
                            ->sucursal($sucursale_id)
                            ->empleado($user_id)
                            ->cliente($cliente_id)
                            ->fechaIni($fecha_ini)
                            ->fechaFin($fecha_fin)
                            ->where('tipo', $tipo)
                            ->when($estado == 1, function($query){
                                return $query->where('estado', 1);
                            })
                            ->count();
        return json_encode([$ventas, $cantidad]);
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
                'user_id'           => Auth::user()->id,
                'cliente_id'        => isset($data['cliente_id']) ? $data['cliente_id'] : null,
                'proveedore_id'     => isset($data['proveedore_id']) ? $data['proveedore_id'] : null,
                'sucursale_id'      => Auth::user()->sucursal->id,
                'folio'             => $folio == null ? 1 : $folio->folio + 1,
                'fecha'             => $fecha->format('Y-m-d H:i:s'),
                'importe'           => floatval($data['subtotal']),
                'iva'               => floatval($data['iva']),
                'descuento'         => floatval($data['descuento']),
                'total'             => (floatval($data['subtotal']) + floatval($data['iva'])) - floatval($data['descuento']),
                'paga_con'          => floatval($data['paga_con']) ,
                'pago_inicial'      => isset($data['pago_inicial']) ?  floatval($data['pago_inicial']) : 0,
                'tipo_pago'         => 0,
                'estado'            => $request->get('tipo_venta') == 3 ? 1 : 0,
                'tipo_venta'        => $request->get('tipo_venta'),
                'tipo_venta_pago'   => 0,
                'periodo_pagos'     => isset($data['periodo_pagos']) ? $data['periodo_pagos'] : null,
                'tipo'              => $data['tipo'],
            ];
            $venta = Venta::create($datos_venta);
            foreach($carrito as $producto)
            {
                $datos_detalle = [
                    'precio'    => floatval($producto->precio),
                    'cantidad'  => intval($producto->cantidad),
                    'importe'   => floatval($producto->precio) * intval($producto->cantidad),
                    'created_at'=> $fecha->format('Y-m-d H:i:s'),
                    'updated_at'=> $fecha->format('Y-m-d H:i:s'),
                ];
                $datos_inventario = [
                    'user_id'       => Auth::user()->id,
                    'sucursale_id'  => Auth::user()->sucursal->id,
                    'almacene_id'   => null,
                    'producto_id'   => $producto->producto_id,
                    'fecha'         => $fecha->format('Y-m-d H:i:s'),
                    'cantidad'      => $producto->cantidad,
                    'tipo'          => $data['tipo']
                ];
                $venta->productos()->attach($producto->producto_id, $datos_detalle);
                $cantidadActual = ProductosSucursal::where([['sucursale_id', Auth::user()->sucursal->id], ['producto_id', $producto->producto_id]])->first();
                if($data['tipo'] == 0)
                {
                    $newCantidad = intval($cantidadActual->stock) - intval($producto->cantidad);
                }else{
                    $newCantidad = intval($cantidadActual->stock) + intval($producto->cantidad);
                }
                $cantidadActual->update(['stock' => $newCantidad]);
                Inventario::create($datos_inventario);
            }
            if(isset($data['periodo_pagos']))
            {
                $fecha_estimada = $fecha;
                $fecha_hora = $fecha;
                $cliente = Cliente::find($data['cliente_id']);
                $total = (floatval($data['subtotal']) + floatval($data['iva'])) - floatval($data['descuento']) - floatval($data['pago_inicial']);
                $dias_periodo = Venta::PERIODO_PAGOS_DIAS[$data['periodo_pagos']];
                $total_periodo = floor($cliente->dias_credito / $dias_periodo);
                $total_periodo = $total_periodo < 1 ? 1 : $total_periodo;
                $monto_perido = $total / $total_periodo;
                for($i = 0; $i < $total_periodo; $i++)
                {
                    $array_pagos = [
                        'venta_id'      => $venta->id,
                        'user_id'       => Auth::user()->id,
                        'fecha_estimada'=> $fecha_estimada->addDays($dias_periodo)->format('Y-m-d H:i:s'),
                        'fecha_hora'    => $fecha_hora->addDays($dias_periodo)->format('Y-m-d H:i:s'),
                        'anticipo'      => 0,
                        'monto'         => $monto_perido,
                        'paga_con'      => 0,
                        'cambio'        => 0,
                        'estado'        => 2,
                        'tipo_pago'     => false,
                    ];
                    Pago::create($array_pagos);
                }
            }
            DB::commit();
            return json_encode([
                'icon'          => 'success', 
                'title'         => 'Exitó', 
                'text'          => 'Venta Realizada', 
                'venta_id'      => $venta->id,
            ]);
        }catch(\Exception $e){
            DB::rollback();
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
    public function searchVenta($folio)
    {
        $settings = Configuracione::find(1);
        $venta = Venta::with(['productos','empleado.persona', 'cliente', 'cliente.persona', 'direccion', 'sucursal', 'pagos'])->where('folio', $folio)->first();
        return json_encode([$venta, $settings]);
    }
    public function show($id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente', 'sucursal'])->find($id);
        $setting = Configuracione::find(1);
        return view('detalle', ['venta' => $venta, 'setting' => $setting]);
    }
    public function remision(Request $request, $id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente', 'sucursal'])->find($id);
        $setting = Configuracione::find(1);
        if($request->get('isPrint') == 'true'){
            return view('print.remision', ['venta' => $venta, 'setting' => $setting]);
        }
        $pdf = Pdf::loadView('print.remision', ['venta' => $venta, 'setting' => $setting]);
        return $pdf->download('Remisión.pdf');
    }
    public function ticket(Request $request, $id)
    {
        $venta = Venta::with(['productos','empleado.sucursal', 'cliente', 'sucursal'])->find($id);
        $setting = Configuracione::find(1);
        if($request->get('isPrint') == 'true'){
            return view('print.ticket', ['venta' => $venta, 'setting' => $setting]);
        }
        $pdf = Pdf::loadView('print.ticket', ['venta' => $venta, 'setting' => $setting]);
        return $pdf->download('Ticket.pdf');
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
