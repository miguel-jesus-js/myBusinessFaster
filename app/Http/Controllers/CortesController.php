<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Gasto;
use App\Models\Configuracione;
use Carbon\Carbon;

class CortesController extends Controller
{
    public function index()
    {
        $info = $this->getInfoCorte();
        return view('corte_caja', $info);
    }
    public function print(Request $request)
    {
        $info = $this->getInfoCorte();
        $efectivo = $request->get('efectivo');
        return view('print.corte_caja', array_merge($info, ['efectivo_contado' => $efectivo]));
    }
    
    public function getInfoCorte()
    {
        $fecha = Carbon::now()->format('Y-m-d');
        $setting = Configuracione::find(1);
        $nVentas = Venta::betwwenDate()->count();
        $ventasEfectivo = Venta::betwwenDate()->where('tipo_pago', 'Efectivo')->sum('total');
        $ventasTarjeta = Venta::betwwenDate()->where('tipo_pago', 'tarjeta')->sum('total');
        $pagos = 0;
        $compras = 0;
        $descuentos = Venta::betwwenDate()->sum('descuento');
        $gastos = Gasto::betwwenDate()->sum('monto');
        //total de ingresos
        $ingresos = floatval($ventasEfectivo) + floatval($ventasTarjeta) + floatval($pagos);
        $egresos = floatval($compras) + floatval($gastos);
        $saldoFinal = $ingresos - $egresos;
        $saldoInicial = 0;
        return [
            'setting'           =>  $setting,
            'nVentas'           =>  $nVentas,
            'ventasEfectivo'    =>  $ventasEfectivo,
            'ventasTarjeta'     =>  $ventasTarjeta,
            'pagos'             =>  $pagos,
            'compras'           =>  $compras,
            'descuentos'        =>  $descuentos,
            'gastos'            =>  $gastos,
            'saldoInicial'      =>  $saldoInicial,
            'saldoFinal'        =>  $saldoFinal,
        ];
    }
}
