<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\TurnosRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Turno;
use App\Imports\TurnosImport;
use App\Exports\TurnosExport;
use PDF;

class TurnosController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $turnos = Turno::withTrashed()->turno($filtro)->get();
                break;
            case 1:
                $turnos = Turno::onlyTrashed()->turno($filtro)->get();
                break;
            case 2:
                $turnos = Turno::whereNull('deleted_at')->turno($filtro)->get();
                break;
        }
        return json_encode($turnos);
    }
    public function create(TurnosRequest $request)
    {
        $data = $request->all();
        try{
            Turno::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Turno registrado']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el turno no fue registrado']);
        }
    }
    public function update(TurnosRequest $request)
    {
        $data = $request->all();
        $turno = Turno::find($data['id']);
        try{
            $turno->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Turno::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Turno eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el turno no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_turnos.xlsx');
        return response()->file($file);
    }
    public function uploadTurno(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
            Excel::import(new TurnosImport, $file);
            return json_encode(['icon' => 'success', 'title' => 'Exitó', 'text' => 'Turnos registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon' => 'error', 'title' => 'Error', 'text' => 'Ocurrio un error, los turnos no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $turnos = Turno::all();
        $pdf = Pdf::loadView('pdf.turnos_pdf', ['turnos' => $turnos, 'esExcel' => false]);
        return $pdf->download('Turnos.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new TurnosExport, 'Turnos.xlsx');
    }
}
