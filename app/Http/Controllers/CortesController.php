<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venta;
use App\Models\Gasto;
use App\Models\Configuracione;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $setting = Configuracione::find(1);
        $nVentas = Venta::betwwenDate()->where('user_id', $user->id)->count();
        $ventasEfectivo = Venta::betwwenDate()->where([['tipo_pago', 'Efectivo'], ['user_id', $user->id]])->sum('total');
        $ventasTarjeta = Venta::betwwenDate()->where([['tipo_pago', 'tarjeta'], ['user_id', $user->id]])->sum('total');
        $pagos = 0;
        $compras = 0;
        $descuentos = Venta::betwwenDate()->sum('descuento');
        $gastos = Gasto::betwwenDate()->where('user_id', $user->id)->sum('monto');
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
