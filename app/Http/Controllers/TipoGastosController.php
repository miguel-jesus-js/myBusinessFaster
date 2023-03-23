<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TipoGastosRequest;
use App\Http\Requests\UploadRequest;
use App\Models\TipoGasto;
use App\Imports\TipoGastosImport;
use App\Exports\TipoGastosExport;
use PDF;

class TipoGastosController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $tipo_gastos = TipoGasto::withTrashed()->tipo($filtro)->get();
                break;
            case 1:
                $tipo_gastos = TipoGasto::onlyTrashed()->tipo($filtro)->get();
                break;
            case 2:
                $tipo_gastos = TipoGasto::whereNull('deleted_at')->tipo($filtro)->get();
                break;
        }
        return json_encode($tipo_gastos);
    }
    public function create(TipoGastosRequest $request)
    {
        $data = $request->all();
        try {
            TipoGasto::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de gasto registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el tipo de gasto no fue registrado']);
        }
    }
    public function update(TipoGastosRequest $request)
    {
        $tipoGasto = TipoGasto::find($request->all()['id']);
        $data = $request->all();
        try {
            $tipoGasto->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            TipoGasto::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de gasto eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el tipo no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_tipo_gastos.xlsx');
        return response()->file($file);
    }
    public function uploadTipoGastos(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new TipoGastosImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de gastos registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los tipo de gastos no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $tipoGastos = TipoGasto::whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.tipo_gastos_pdf', ['tipoGastos' => $tipoGastos, 'esExcel' => false]);
        return $pdf->download('Tipo de gastos.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new TipoGastosExport, 'Tipo de gastos.xlsx');
    }
}
