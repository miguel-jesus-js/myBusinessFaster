<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Categoria;
use App\Imports\CategoriasImport;
use App\Exports\CategoriasExport;
use App\Http\Requests\CategoriasRequest;
use App\Http\Requests\CategoriasUploadRequest;
use PDF;

class CategoriasController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $categorias = Categoria::withTrashed()->categoria($filtro)->get();
                break;
            case 1:
                $categorias = Categoria::onlyTrashed()->categoria($filtro)->get();
                break;
            case 2:
                $categorias = Categoria::whereNull('deleted_at')->categoria($filtro)->get();
                break;
        }
        return json_encode($categorias);
    }
    public function create(CategoriasRequest $request)
    {
        $data = $request->all();
        try {
            Categoria::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Categoria registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la Categoria no fue registrada']);
        }
    }
    public function update(CategoriasRequest $request)
    {
        $categorias = Categoria::find($request->all()['id']);
        $data = $request->all();
        try {
            $categorias->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Categoria::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Categoria eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la Categoria no fue eliminada']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_categorias.xlsx');
        return response()->file($file);
    }
    public function uploadCategoria(CategoriasUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new CategoriasImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Categorias registradas']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las categorias no fueron registradas']);
        }
    }
    public function exportarPDF()
    {
        $categorias = Categoria::whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.categoria_pdf', ['categorias' => $categorias, 'esExcel' => false]);
        return $pdf->download('Categorías.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new CategoriasExport, 'Categorías.xlsx');
    }
}
