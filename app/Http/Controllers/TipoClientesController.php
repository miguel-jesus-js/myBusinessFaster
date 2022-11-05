<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\TipoCliente;
use App\Imports\TipoClientesImport;
use App\Http\Requests\TipoClientesRequest;
use App\Http\Requests\TipoClientesUploadRequest;
use PDF;

class TipoClientesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $tipo_clientes = TipoCliente::withTrashed()->tipoCliente($filtro)->get();
                break;
            case 1:
                $tipo_clientes = TipoCliente::onlyTrashed()->tipoCliente($filtro)->get();
                break;
            case 2:
                $tipo_clientes = TipoCliente::whereNull('deleted_at')->tipoCliente($filtro)->get();
                break;
        }
        return json_encode($tipo_clientes);
    }
    public function create(TipoClientesRequest $request)
    {
        $request->validate([
            'tipo_cliente'       => 'required',
        ]);
        $data = $request->all();
        try {
            TipoCliente::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de cliente registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el tipo de cliente no fue registrado']);
        }
    }
    public function update(TipoClientesRequest $request)
    {
        $request->validate([
            'id'          => 'required',
            'tipo_cliente'       => 'required',
        ]);
        $tipo_clientes = TipoCliente::find($request->all()['id']);
        $data = $request->all();
        try {
            $tipo_clientes->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            TipoCliente::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de cliente eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el tipo de cliente no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_tipo_clientes.xlsx');
        return response()->file($file);
    }
    public function uploadTipoCliente(TipoClientesUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new TipoClientesImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de clientes registrados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los tipos de clientes no fueron registradas']);
        }
    }
    public function exportarPDF()
    {
        $tipo_clientes = TipoCliente::whereNull('deleted_at')->get();
        view()->share('pdf.tipo_clientes_pdf',$tipo_clientes);
        $pdf = Pdf::loadView('pdf.tipo_clientes_pdf', ['tipo_clientes' => $tipo_clientes]);
        return $pdf->download('tipo_clientes.pdf');
    }
}
