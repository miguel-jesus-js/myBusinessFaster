<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AlmacenesRequest;
use App\Http\Requests\UploadRequest;
use App\Models\Almacene;
use App\Imports\AlmacenesImport;
use App\Exports\AlmacenesExport;
use PDF;

class AlmacenesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        $sucursal = $request->get('sucursal');
        $isAdmin = Auth::user()->is_admin;
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $almacenes = Almacene::with('sucursal')->withTrashed()->almacen($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
            case 1:
                $almacenes = Almacene::with('sucursal')->onlyTrashed()->almacen($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
            case 2:
                $almacenes = Almacene::with('sucursal')->whereNull('deleted_at')->almacen($filtro)->isAdmin($isAdmin)->sucursal($sucursal)->get();
                break;
        }
        return json_encode($almacenes);
    }
    public function create(AlmacenesRequest $request)
    {
        $data = $request->all();
        if(!Auth::user()->isAdmin)
        {
            $data = array_merge($data, ['sucursale_id' => Auth::user()->sucursal->id]);
        }
        try{
            Almacene::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Almacén registrado']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el almacén no fue registrado']);
        }
    }
    public function update(AlmacenesRequest $request)
    {
        $data = $request->all();
        $almacen = Almacene::find($data['id']);
        try{
            $almacen->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Almacene::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Almacén eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el almacen no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_almacenes.xlsx');
        return response()->file($file);
    }
    public function uploadAlmacen(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
            Excel::import(new AlmacenesImport, $file);
            return json_encode(['icon' => 'success', 'title' => 'Exitó', 'text' => 'Almacenes registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon' => 'error', 'title' => 'Error', 'text' => 'Ocurrio un error, los almacenes no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $almacenes = Almacene::all();
        $pdf = Pdf::loadView('pdf.almacenes_pdf', ['almacenes' => $almacenes, 'esExcel' => false]);
        return $pdf->download('Almacenes.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new AlmacenesExport, 'Almacenes.xlsx');
    }
}
