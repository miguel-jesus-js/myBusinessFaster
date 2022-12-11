<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProveedoresRequest;
use App\Http\Requests\ProveedoresUploadRequest;
use App\Models\Proveedore;
use App\Imports\ProveedoresImport;
use PDF;

class ProveedoresController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $proveedores = Proveedore::withTrashed()->proveedor($filtro)->get();
                break;
            case 1:
                $proveedores = Proveedore::onlyTrashed()->proveedor($filtro)->get();
                break;
            case 2:
                $proveedores = Proveedore::whereNull('deleted_at')->proveedor($filtro)->get();
                break;
        }
        return json_encode($proveedores);
    }
    public function create(ProveedoresRequest $request)
    {
        $data = $request->all();
        try {
            Proveedore::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Proveedor registrado']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el proveedor no fue registrado']);
        }
    }
    public function update(ProveedoresRequest $request)
    {
        $proveedores = Proveedore::find($request->all()['id']);
        $data = $request->all();
        try {
            $proveedores->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Proveedore::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Proveedor eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el Proveedor no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_proveedores.xlsx');
        return response()->file($file);
    }
    public function uploadProveedor(ProveedoresUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new ProveedoresImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Proveedores registrados']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los proveedores no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $proveedores = Proveedore::whereNull('deleted_at')->get();
        view()->share('pdf.proveedores_pdf',$proveedores);
        $pdf = Pdf::loadView('pdf.proveedores_pdf', ['proveedores' => $proveedores])->setPaper('a4', 'landscape');
        return $pdf->download('proveedores.pdf');
    }
}
