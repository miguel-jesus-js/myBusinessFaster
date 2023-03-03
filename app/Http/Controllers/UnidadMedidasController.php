<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\UnidadMedida;
use App\Imports\UnidadMedidasImport;
use App\Exports\UnidadMedidasExport;
use App\Http\Requests\UnidadMedidasRequest;
use App\Http\Requests\UnidadMedidasUploadRequest;
use PDF;

class UnidadMedidasController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $unidad_medias = UnidadMedida::withTrashed()->unidadMedida($filtro)->get();
                break;
            case 1:
                $unidad_medias = UnidadMedida::onlyTrashed()->unidadMedida($filtro)->get();
                break;
            case 2:
                $unidad_medias = UnidadMedida::whereNull('deleted_at')->unidadMedida($filtro)->get();
                break;
        }
        return json_encode($unidad_medias);
    }
    public function create(UnidadMedidasRequest $request)
    {
        $data = $request->all();
        try {
            UnidadMedida::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Unidad de medida registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la unidad de medida no fue registrada']);
        }
    }
    public function update(UnidadMedidasRequest $request)
    {
        $unidad_medidas = UnidadMedida::find($request->all()['id']);
        $data = $request->all();
        try {
            $unidad_medidas->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            UnidadMedida::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Unidad de medida eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la unidad de medida no fue eliminada']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_unidad_medidas.xlsx');
        return response()->file($file);
    }
    public function uploadUnidadMedida(UnidadMedidasUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new UnidadMedidasImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Unidades de medidas registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las unidades de medidas no fueron registradas']);
        }
    }
    public function exportarPDF()
    {
        $unidadMedidas = UnidadMedida::whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.unidad_medidas_pdf', ['unidadMedidas' => $unidadMedidas, 'esExcel' => false]);
        return $pdf->download('Unidades de medida.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new UnidadMedidasExport, 'Unidades de medida.xlsx');
    }
}
