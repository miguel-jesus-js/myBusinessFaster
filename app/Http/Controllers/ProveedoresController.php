<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\PersonasRequest;
use App\Http\Requests\ProveedoresRequest;
use App\Http\Requests\ProveedoresUploadRequest;
use App\Models\Persona;
use App\Models\Proveedore;
use App\Models\DireccionesEntrega;
use App\Imports\ProveedoresImport;
use App\Exports\ProveedoresExport;
use Illuminate\Support\Facades\DB;
use PDF;

class ProveedoresController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $proveedores = Proveedore::with(['persona', 'persona.direcciones'])->withTrashed()->proveedor($filtro)->get();
                break;
            case 1:
                $proveedores = Proveedore::with(['persona', 'persona.direcciones'])->onlyTrashed()->proveedor($filtro)->get();
                break;
            case 2:
                $proveedores = Proveedore::with(['persona', 'persona.direcciones'])->whereNull('deleted_at')->proveedor($filtro)->get();
                break;
        }
        return json_encode($proveedores);
    }
    public function create(PersonasRequest $personaRequest, ProveedoresRequest $proveedorRequest)
    {
        $data = $personaRequest->all();
        try {
            DB::beginTransaction();
            $persona = Persona::create($data);
            $data = array_merge($data, ['persona_id' => $persona->id]);
            Proveedore::create($data);
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
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Proveedor registrado']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el proveedor no fue registrado']);
        }
    }
    public function update(PersonasRequest $personaRequest, ProveedoresRequest $proveedorRequest)
    {
        $data = $personaRequest->all();
        $persona = Persona::find($data['id']);
        $proveedor = Proveedore::find($data['cliente_id']);
        try {
            DB::beginTransaction();
            $proveedor->update($data);
            $persona->update($data);
            if(isset($data['ciudad']))
            {
                for($i = 0; $i < sizeof($data['ciudad']); $i++)
                {
                    $dataDirecc = [
                        'persona_id'      => $proveedor->persona_id, 
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
        $proveedores = Proveedore::with('persona')->whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.proveedores_pdf', ['proveedores' => $proveedores, 'esExcel' => false]);
        return $pdf->download('Proveedores.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new ProveedoresExport, 'Proveedores.xlsx');
    }
}
