<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\MarcasRequest;
use App\Http\Requests\MarcasUploadRequest;
use App\Models\Marca;
use App\Imports\MarcasImport;
use PDF;

class MarcasController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $marcas = Marca::withTrashed()->marca($filtro)->get();
                break;
            case 1:
                $marcas = Marca::onlyTrashed()->marca($filtro)->get();
                break;
            case 2:
                $marcas = Marca::whereNull('deleted_at')->marca($filtro)->get();
                break;
        }
        return json_encode($marcas);
    }
    public function create(MarcasRequest $request)
    {
        $request->validate([
            'marca'       => 'required',
        ]);
        $data = $request->all();
        try {
            Marca::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marca registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la marca no fue registrada']);
        }
    }
    public function update(MarcasRequest $request)
    {
        $request->validate([
            'id'          => 'required',
            'marca'       => 'required',
        ]);
        $marcas = Marca::find($request->all()['id']);
        $data = $request->all();
        try {
            $marcas->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Marca::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marca eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la marca no fue eliminada']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_marcas.xlsx');
        return response()->file($file);
    }
    public function uploadMarca(MarcasUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new MarcasImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marcas registradas']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las marcas no fueron registradas']);
        }
    }
    public function exportarPDF()
    {
        $marcas = Marca::whereNull('deleted_at')->get();
        view()->share('pdf.marcas_pdf',$marcas);
        $pdf = Pdf::loadView('pdf.marcas_pdf', ['marcas' => $marcas]);
        return $pdf->download('marcas.pdf');
    }
}
