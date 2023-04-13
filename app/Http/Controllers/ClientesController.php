<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ClientesRequest;
use App\Http\Requests\ClientesUploadRequest;
use App\Models\Persona;
use App\Models\Cliente;
use App\Imports\ClientesImport;
use App\Exports\ClientesExport;
use App\Models\DireccionesEntrega;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class ClientesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $clientes = Cliente::with(['tipo_cliente', 'persona', 'persona.direcciones'])->withTrashed()->cliente($filtro)->get();
                break;
            case 1:
                $clientes = Cliente::with(['tipo_cliente', 'persona', 'persona.direcciones'])->onlyTrashed()->cliente($filtro)->get();
                break;
            case 2:
                $clientes = Cliente::with(['tipo_cliente', 'persona', 'persona.direcciones'])->whereNull('clientes.deleted_at')->cliente($filtro)->get();
                break;
        }
        return json_encode($clientes);
    }
    public function create(ClientesRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['email']);
        try {
            DB::beginTransaction();
            $persona = Persona::create($data);
            $data = array_merge($data, ['persona_id' => $persona->id]);
            $cliente = Cliente::create($data);
            if(isset($data['ciudad']))
            {
                for($i = 0; $i < sizeof($data['ciudad']); $i++)
                {
                    $dataDirecc = [
                        'persona_id'      => $persona->id, 
                        'ciudad'          => $data['ciudad'][$i],
                        'estado'          => $data['estado'][$i],
                        'municipio'       => $data['municipio'][$i],
                        'cp'              => $data['cp'][$i],
                        'colonia'         => $data['colonia'][$i],
                        'calle'           => $data['calle'][$i],
                        'n_exterior'      => $data['n_exterior'][$i],
                        'n_interior'      => $data['n_interior'][$i],
                    ];
                    DireccionesEntrega::create($dataDirecc);
                }
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Cliente registrado']);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el cliente no fue registrado']);
        }
    }
    public function update(ClientesRequest $request)
    {
        $data = $request->all();
        $cliente = Cliente::find($data['id'])->first();
        $persona = Persona::find($cliente->persona_id);
        try {
            DB::beginTransaction();
            $cliente->update($data);
            $persona->update($data);
            if(isset($data['ciudad']))
            {
                for($i = 0; $i < sizeof($data['ciudad']); $i++)
                {
                    $dataDirecc = [
                        'persona_id'      => $cliente->persona_id, 
                        'ciudad'          => $data['ciudad'][$i],
                        'estado'          => $data['estado'][$i],
                        'municipio'       => $data['municipio'][$i],
                        'cp'              => $data['cp'][$i],
                        'colonia'         => $data['colonia'][$i],
                        'calle'           => $data['calle'][$i],
                        'n_exterior'      => $data['n_exterior'][$i] == null ? 0 : $data['n_exterior'][$i],
                        'n_interior'      => $data['n_interior'][$i] == null ? 0 : $data['n_interior'][$i],
                    ];
                    if($data['d-id'][$i] == null)
                    {
                        DireccionesEntrega::create($dataDirecc);
                    }else{
                        $direccion = DireccionesEntrega::find($data['d-id'][$i]);
                        $direccion->update($dataDirecc);
                    }
                }
            }
            DB::commit();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            dd($e);
            DB::rollback();
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Cliente::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Cliente eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el cliente no fue eliminado']);
        }
    }
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_clientes.xlsx');
        return response()->file($file);
    }
    public function uploadCliente(ClientesUploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
             Excel::import(new ClientesImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Clientes registrados']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los clientes no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $clientes = Cliente::with(['tipo_cliente', 'persona'])->whereNull('clientes.deleted_at')->get();
        $pdf = Pdf::loadView('pdf.clientes_pdf', ['clientes' => $clientes, 'esExcel' => false])->setPaper('a4', 'landscape');
        return $pdf->download('Clientes.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new ClientesExport, 'Clientes.xlsx');
    }
}
