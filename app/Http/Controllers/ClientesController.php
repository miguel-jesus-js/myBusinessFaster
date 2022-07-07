<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\DireccionesEntrega;
use Illuminate\Support\Facades\DB;

class ClientesController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $clientes = Cliente::with('tipo_cliente')->withTrashed()->get();
                break;
            case 1:
                $clientes = Cliente::with('tipo_cliente')->onlyTrashed()->get();
                break;
            case 2:
                $clientes = Cliente::with('tipo_cliente')->whereNull('deleted_at')->get();
                break;
            default:
                $clientes = Cliente::with('tipo_cliente')->where('nombres', 'like', '%'.$filtro.'%')
                                ->orWhere('app', 'like', '%'.$filtro.'%')
                                ->orWhere('apm', 'like', '%'.$filtro.'%')
                                ->orWhere('telefono', 'like', '%'.$filtro.'%')
                                ->orWhere('email', 'like', '%'.$filtro.'%')
                                ->orWhere('empresa', 'like', '%'.$filtro.'%')
                                ->get();
                break;
        }
        for($i=0; $i<count($clientes); $i++){
            $direcciones = DireccionesEntrega::leftJoin('clientes', 'direcciones_entregas.cliente_id', '=', 'clientes.id')
                ->select('direcciones_entregas.*')->where('direcciones_entregas.cliente_id', $clientes[$i]->id)
                ->get();
            $clientes[$i]->direcciones = $direcciones;
        }
        return json_encode($clientes);
    }
    public function create(Request $request)
    {
        $request->validate([
            'tipo_cliente_id'       => 'required',
            'nombres'               => 'required',
            'app'                   => 'required',
            'apm'                   => 'required',
            'email'                 => 'required',
            'telefono'              => 'required',
            'ciudad'                => 'required',
            'estado'                => 'required',
            'municipio'             => 'required',
            'cp'                    => 'required',
            'colonia'               => 'required',
            'calle'                 => 'required',
            'n_exterior'            => 'required'

        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['email']);
        if(Cliente::where('email', $data['email'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(Cliente::where('telefono', $data['telefono'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(Cliente::where('rfc', $data['rfc'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else{
            try {
                DB::beginTransaction();
                $newCliente = Cliente::create($data);
                $datos = json_decode($data['datos']);
                for($i = 0; $i < sizeof($datos); $i++)
                {
                    $datos[$i]->cliente_id      = $newCliente->id;
                    $newDireccion               = new DireccionesEntrega();
                    $newDireccion->cliente_id   = $datos[$i]->cliente_id;                                 
                    $newDireccion->ciudad       = $datos[$i]->ciudad;                   
                    $newDireccion->estado       = $datos[$i]->estado;                   
                    $newDireccion->municipio    = $datos[$i]->municipio;                   
                    $newDireccion->cp           = $datos[$i]->cp; 
                    $newDireccion->colonia      = $datos[$i]->colonia; 
                    $newDireccion->calle        = $datos[$i]->calle; 
                    $newDireccion->n_exterior   = $datos[$i]->n_exterior; 
                    if($datos[$i]->n_interior == ''){
                        $newDireccion->n_interior = null;
                    } else{
                        $newDireccion->n_interior   = $datos[$i]->n_interior; 
                    }
                    $newDireccion->save();               
                }
                DB::commit();
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Cliente registrado']);
            } catch (\Exception $e) {
                DB::rollback();
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el cliente no fue registrado']);
            }
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'                    => 'required',
            'tipo_cliente_id'       => 'required',
            'nombres'               => 'required',
            'app'                   => 'required',
            'apm'                   => 'required',
            'email'                 => 'required',
            'telefono'              => 'required',
            'ciudad'                => 'required',
            'estado'                => 'required',
            'municipio'             => 'required',
            'cp'                    => 'required',
            'colonia'               => 'required',
            'calle'                 => 'required',
            'n_exterior'            => 'required'
        ]);
        $clientes = Cliente::find($request->all()['id']);
        $data = $request->all();
        if(Cliente::where([['email', $data['email']], ['id', '<>', $clientes['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(Cliente::where([['telefono', $data['telefono']], ['id', '<>', $clientes['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(Cliente::where([['rfc', $data['rfc']], ['id', '<>', $clientes['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else{
            try {
                DB::beginTransaction();
                $clientes->update($data);
                $direcciones = DireccionesEntrega::where('cliente_id', $clientes->id)->delete();//eliminamos los permisos
                $datos = json_decode($data['datos']);
                for($i = 0; $i < sizeof($datos); $i++)
                {
                    $datos[$i]->cliente_id      = $clientes->id;
                    $newDireccion               = new DireccionesEntrega();
                    $newDireccion->cliente_id   = $datos[$i]->cliente_id;                                 
                    $newDireccion->ciudad       = $datos[$i]->ciudad;                   
                    $newDireccion->estado       = $datos[$i]->estado;                   
                    $newDireccion->municipio    = $datos[$i]->municipio;                   
                    $newDireccion->cp           = $datos[$i]->cp; 
                    $newDireccion->colonia      = $datos[$i]->colonia; 
                    $newDireccion->calle        = $datos[$i]->calle; 
                    $newDireccion->n_exterior   = $datos[$i]->n_exterior; 
                    if($datos[$i]->n_interior == ''){
                        $newDireccion->n_interior = null;
                    } else{
                        $newDireccion->n_interior   = $datos[$i]->n_interior; 
                    }
                    $newDireccion->save();               
                }
                DB::commit();
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
            } catch (\Exception $e) {
                DB::rollback();
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
            }
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
}
