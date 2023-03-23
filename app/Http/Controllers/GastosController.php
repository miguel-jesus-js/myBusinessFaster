<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Gasto;
use App\Exports\GastosExport;
Use App\Traits\ImagesTrait;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use PDF;

class GastosController extends Controller
{
    use ImagesTrait;
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $gastos = Gasto::with(['user', 'tipoGasto'])->withTrashed()->get();
                break;
            case 1:
                $gastos = Gasto::with(['user', 'tipoGasto'])->onlyTrashed()->get();
                break;
            case 2:
                $gastos = Gasto::with(['user', 'tipoGasto'])->whereNull('deleted_at')->get();
                break;
        }
        return json_encode($gastos);
    }
    public function create(Request $request)
    {

        $data = $request->all();
        try {
            $data['comprobante'] = $this->uploadImagen($request->file('comprobante'), 'comprobante', 'img/comprobantes/');
            if($data['comprobante'] == null || $data['comprobante'] == '')
            {
                unset($data['comprobante']);
            }
            $fecha = Carbon::now()->format('Y-m-d H:i:s');
            $data = array_merge($data, ['user_id' => Auth::user()->id, 'fecha_hora' => $fecha]);
            Gasto::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Gasto registrado']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el gasto no fue registrado']);
        }
    }
    public function update(Request $request)
    {
        $gastos = Gasto::find($request->all()['id']);
        $data['comprobante'] = $this->uploadImagen($request->file('comprobante'), 'comprobante', 'img/comprobantes/');
        if($data['comprobante'] == null)
        {
            unset($data['comprobante']);
        }else{
            $this->deleteImagen('img/comprobantes', $gastos->comprobante);
        }
        $data = $request->all();
        try {
            $gastos->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function show($id)
    {
        $gasto = Gasto::with(['user', 'tipoGasto'])->find($id);
        return view('gastos_show', ['gasto' => $gasto]);
    }
    public function delete($id)
    {
        try {
            Gasto::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Gasto eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el gasto no fue eliminado']);
        }
    }
    public function exportarPDF()
    {
        $gastos = Gasto::whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.gastos_pdf', ['gastos' => $gastos, 'esExcel' => false]);
        return $pdf->download('Gastos.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new GastosExport, 'Gastos.xlsx');
    }
}
