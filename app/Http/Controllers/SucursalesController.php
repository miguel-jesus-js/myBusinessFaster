<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\SucursalesRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Sucursale;
use App\Imports\SucursalesImport;
use App\Exports\SucursalesExport;
use PDF;

class SucursalesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $sucursales = Sucursale::with('responsable')->withTrashed()->sucursal($filtro)->get();
                break;
            case 1:
                $sucursales = Sucursale::with('responsable')->onlyTrashed()->sucursal($filtro)->get();
                break;
            case 2:
                $sucursales = Sucursale::with('responsable')->whereNull('deleted_at')->sucursal($filtro)->get();
                break;
        }
        return json_encode($sucursales);
    }
    public function create(SucursalesRequest $request)
    {
        $data = $request->all();
        try{
            Sucursale::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Sucursal registrada']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la sucursal no fue registrada']);
        }
    }
    public function update(SucursalesRequest $request)
    {
        $data = $request->all();
        $sucursal = Sucursale::find($data['id']);
        try{
            $sucursal->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Sucursale::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Sucursal eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la sucursal no fue eliminada']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_sucursales.xlsx');
        return response()->file($file);
    }
    public function uploadSucursal(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
            Excel::import(new SucursalesImport, $file);
            return json_encode(['icon' => 'success', 'title' => 'Exitó', 'text' => 'Sucursales registradas']);
        } catch (\Exception $e) {
            return $e;
            return json_encode(['icon' => 'error', 'title' => 'Error', 'text' => $e]);
        }
    }
    public function exportarPDF()
    {
        $sucursales = Sucursale::with('responsable')->get();
        $pdf = Pdf::loadView('pdf.sucursales_pdf', ['sucursales' => $sucursales, 'esExcel' => false]);
        return $pdf->download('Sucursales.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new SucursalesExport, 'Sucursales.xlsx');
    }
}
