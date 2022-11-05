<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Materiale;
use App\Http\Requests\MaterialesRequest;
use App\Http\Requests\MaterialesUploadRequest;
use App\Imports\MaterialesImport;
use PDF;

class MaterialesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $materiales = Materiale::withTrashed()->material($filtro)->get();
                break;
            case 1:
                $materiales = Materiale::onlyTrashed()->material($filtro)->get();
                break;
            case 2:
                $materiales = Materiale::whereNull('deleted_at')->material($filtro)->get();
                break;
        }
        return json_encode($materiales);
    }
    public function create(MaterialesRequest $request)
    {
        $data = $request->all();
        try {
            Materiale::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Material registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el material no fue registrado']);
        }
    }
    public function update(MaterialesRequest $request)
    {
        $request->validate([
            'id'          => 'required',
            'material'       => 'required',
        ]);
        $material = Materiale::find($request->all()['id']);
        $data = $request->all();
        try {
            $material->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Materiale::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Material eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el material no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_materiales.xlsx');
        return response()->file($file);
    }
    public function uploadMaterial(MaterialesUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new MaterialesImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Materiales registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los materiales no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $materiales = Materiale::whereNull('deleted_at')->get();
        view()->share('pdf.materiales_pdf',$materiales);
        $pdf = Pdf::loadView('pdf.materiales_pdf', ['materiales' => $materiales]);
        return $pdf->download('materiales.pdf');
    }
}
