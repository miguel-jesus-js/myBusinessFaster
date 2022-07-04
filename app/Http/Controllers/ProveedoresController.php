<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedore;

class ProveedoresController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $proveedores = Proveedore::withTrashed()->get();
                break;
            case 1:
                $proveedores = Proveedore::onlyTrashed()->get();
                break;
            case 2:
                $proveedores = Proveedore::whereNull('deleted_at')->get();
                break;
            default:
                $proveedores = Proveedore::where('nombres', 'like', '%'.$filtro.'%')
                                ->orWhere('app', 'like', '%'.$filtro.'%')
                                ->orWhere('apm', 'like', '%'.$filtro.'%')
                                ->orWhere('telefono', 'like', '%'.$filtro.'%')
                                ->orWhere('email', 'like', '%'.$filtro.'%')
                                ->orWhere('clave', 'like', '%'.$filtro.'%')
                                ->orWhere('empresa', 'like', '%'.$filtro.'%')
                                ->get();
                break;
        }
        return json_encode($proveedores);
    }
    public function create(Request $request)
    {
        $request->validate([
            'clave'       => 'required',
            'nombres'       => 'required',
            'app'           => 'required',
            'apm'           => 'required',
            'email'         => 'required',
            'telefono'      => 'required',
            'ciudad'        => 'required',
            'estado'        => 'required',
            'municipio'     => 'required',
            'cp'            => 'required',
            'colonia'       => 'required',
            'calle'         => 'required',
            'n_exterior'    => 'required'

        ]);
        $data = $request->all();
        if(Proveedore::where('email', $data['email'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(Proveedore::where('telefono', $data['telefono'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(Proveedore::where('rfc', $data['rfc'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else if(Proveedore::where('clave', $data['clave'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'La clave '.$request->all()['clave'].' ya ha sido registrada']);
        }else{
            try {
                Proveedore::create($data);
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Proveedor registrado']);
            } catch (\Exception $e) {
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el proveedor no fue registrado']);
            }
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'clave'         => 'required',
            'nombres'       => 'required',
            'app'           => 'required',
            'apm'           => 'required',
            'email'         => 'required',
            'telefono'      => 'required',
            'ciudad'        => 'required',
            'estado'        => 'required',
            'municipio'     => 'required',
            'cp'            => 'required',
            'colonia'       => 'required',
            'calle'         => 'required',
            'n_exterior'    => 'required',
        ]);
        $proveedores = Proveedore::find($request->all()['id']);
        $data = $request->all();
        if(Proveedore::where([['email', $data['email']], ['id', '<>', $proveedores['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(Proveedore::where([['telefono', $data['telefono']], ['id', '<>', $proveedores['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(Proveedore::where([['rfc', $data['rfc']], ['id', '<>', $proveedores['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else if(Proveedore::where([['clave', $data['clave']], ['id', '<>', $proveedores['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'La clave '.$request->all()['clave'].' ya ha sido registrado']);
        }else{
            try {
                $proveedores->update($data);
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
            } catch (\Exception $e) {
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
            }
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
}
