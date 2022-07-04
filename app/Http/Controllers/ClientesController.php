<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\DireccionesEntrega;

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
                                ->empresa('empresa', 'like', '%'.$filtro.'%')
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
        if(Cliente::where('email', $data['email'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(Cliente::where('telefono', $data['telefono'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(Cliente::where('rfc', $data['rfc'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else{
            try {
                $newCliente = Cliente::create($data);
                // $datos = json_decode($data['datos']);
                // for($i = 0; $i < sizeof($datos); $i++)
                // {
                //     $datos[$i]->user_id = $newUser->id;
                //     $newAcceso = new Acceso();
                //     $newAcceso->user_id = $datos[$i]->user_id;                  
                //     $newAcceso->modulo_id = $datos[$i]->modulo_id;                  
                //     $newAcceso->c = $datos[$i]->c;                   
                //     $newAcceso->r = $datos[$i]->r;                   
                //     $newAcceso->u = $datos[$i]->u;                   
                //     $newAcceso->d = $datos[$i]->d; 
                //     $newAcceso->save();               
                // }
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Cliente registrado']);
            } catch (\Exception $e) {
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
                $clientes->update($data);
                // $accesos = Acceso::where('user_id', $clientes->id)->delete();//eliminamos los permisos
                // $datos = json_decode($data['datos']);
                // for($i = 0; $i < sizeof($datos); $i++)
                //     {//recorremos los permisos y los asignamos
                //         $datos[$i]->user_id = $clientes->id;
                //         $newAcceso = new Acceso();
                //         $newAcceso->user_id = $datos[$i]->user_id;                  
                //         $newAcceso->modulo_id = $datos[$i]->modulo_id;                  
                //         $newAcceso->c = $datos[$i]->c;                   
                //         $newAcceso->r = $datos[$i]->r;                   
                //         $newAcceso->u = $datos[$i]->u;                   
                //         $newAcceso->d = $datos[$i]->d; 
                //         $newAcceso->save();               
                //     }
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
            } catch (\Exception $e) {
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
