<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ClientesRequest;
use App\Http\Requests\ClientesUploadRequest;
use App\Models\Cliente;
use App\Imports\ClientesImport;
use App\Models\DireccionesEntrega;
use Illuminate\Support\Facades\DB;
use PDF;

class ClientesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $clientes = Cliente::with('tipo_cliente')->withTrashed()->cliente($filtro)->get();
                break;
            case 1:
                $clientes = Cliente::with('tipo_cliente')->onlyTrashed()->cliente($filtro)->get();
                break;
            case 2:
                $clientes = Cliente::with('tipo_cliente')->whereNull('deleted_at')->cliente($filtro)->get();
                break;
        }
        for($i=0; $i<count($clientes); $i++){
            $direcciones = DireccionesEntrega::leftJoin('clientes', 'direcciones_entregas.d-cliente_id', '=', 'clientes.id')
                ->select('direcciones_entregas.*')->where('direcciones_entregas.d-cliente_id', $clientes[$i]->id)
                ->get();
            $clientes[$i]->direcciones = $direcciones;
        }
        return json_encode($clientes);
    }
    public function create(ClientesRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['email']);
        try {
            DB::beginTransaction();
            $newCliente = Cliente::create($data);
            if(isset($data['d-ciudad']))
            {
                for($i = 0; $i < sizeof($data['d-ciudad']); $i++)
                {
                    $dataDirecc = [
                        'd-cliente_id'      => $newCliente->id, 
                        'd-ciudad'          => $data['d-ciudad'][$i],
                        'd-estado'          => $data['d-estado'][$i],
                        'd-municipio'       => $data['d-municipio'][$i],
                        'd-cp'              => $data['d-cp'][$i],
                        'd-colonia'         => $data['d-colonia'][$i],
                        'd-calle'           => $data['d-calle'][$i],
                        'd-n_exterior'      => $data['d-n_exterior'][$i],
                        'd-n_interior'      => $data['d-n_interior'][$i],
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
        $cliente = Cliente::find($request->all()['id']);
        $data = $request->all();
        try {
            DB::beginTransaction();
            $cliente->update($data);
            if(isset($data['d-ciudad']))
            {
                for($i = 0; $i < sizeof($data['d-ciudad']); $i++)
                {
                    $dataDirecc = [
                        'd-cliente_id'      => $cliente->id, 
                        'd-ciudad'          => $data['d-ciudad'][$i],
                        'd-estado'          => $data['d-estado'][$i],
                        'd-municipio'       => $data['d-municipio'][$i],
                        'd-cp'              => $data['d-cp'][$i],
                        'd-colonia'         => $data['d-colonia'][$i],
                        'd-calle'           => $data['d-calle'][$i],
                        'd-n_exterior'      => $data['d-n_exterior'][$i] = $data['d-n_exterior'][$i] == null ? 0 : $data['d-n_exterior'][$i],
                        'd-n_interior'      => $data['d-n_interior'][$i] = $data['d-n_interior'][$i] == null ? 0 : $data['d-n_interior'][$i],
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
        $clientes = Cliente::whereNull('deleted_at')->get();
        view()->share('pdf.clientes_pdf',$clientes);
        $pdf = Pdf::loadView('pdf.clientes_pdf', ['clientes' => $clientes])->setPaper('a4', 'landscape');
        return $pdf->download('clientes.pdf');
    }
}
