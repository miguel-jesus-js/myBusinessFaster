<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\Configuracione;
use App\Models\Pago;
use App\Models\Venta;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class PagosController extends Controller
{
    public function realizarPagos()
    {
        $setting = Configuracione::find(1);
        $venta = Venta::find(1);
        return view('realizar_pago', ['setting' => $setting, 'venta' => $venta]);
    }
    public function create(Request $request){
        $data = $request->all();
        $pago = Pago::find($data['id']);
        $data = array_merge($data, ['user_id' => Auth::user()->id, 'fecha_hora' =>  Carbon::now()->format('Y-m-d H:i:s'), 'estado' => 1]);
        try{
            $pago->update($data);
            return json_encode(['icon' => 'success', 'title' => 'Exitó', 'text' => 'Pago Realizado', 'id' => $pago->id]);
        }catch(Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el pago no fue registrado']);
        }
    }
    public function ticketPago($id)
    {
        $pago = Pago::with(['venta', 'venta.sucursal', 'empleado'])->find($id);
        $setting = Configuracione::find(1);
        return view('print.ticket_pago', ['pago' => $pago, 'setting' => $setting]);
        // if($request->get('isPrint') == 'true'){
        // }
        // $pdf = Pdf::loadView('print.ticket', ['venta' => $venta, 'setting' => $setting]);
        // return $pdf->download('Ticket.pdf');
    }
}
