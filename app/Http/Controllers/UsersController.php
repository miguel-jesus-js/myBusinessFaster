<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Modulo;
use App\Models\Acceso;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $usuarios = User::with('role')->withTrashed()->get();
                break;
            case 1:
                $usuarios = User::with('role')->onlyTrashed()->get();
                break;
            case 2:
                $usuarios = User::with('role')->whereNull('deleted_at')->get();
                break;
            default:
                $usuarios = User::with('role')->where('nombres', 'like', '%'.$filtro.'%')
                                ->orWhere('app', 'like', '%'.$filtro.'%')
                                ->orWhere('apm', 'like', '%'.$filtro.'%')
                                ->orWhere('telefono', 'like', '%'.$filtro.'%')
                                ->orWhere('email', 'like', '%'.$filtro.'%')
                                ->orWhere('nom_user', 'like', '%'.$filtro.'%')
                                ->get();
                break;
        }
        for($i=0; $i<count($usuarios); $i++){
            $accesos = Acceso::leftJoin('modulos', 'accesos.modulo_id', '=', 'modulos.id')
                ->select('accesos.*', 'modulos.modulo')->where('accesos.user_id', $usuarios[$i]->id)
                ->get();
            $usuarios[$i]->accesos = $accesos;
        }
        return json_encode($usuarios);
    }
    public function create(Request $request)
    {
        $request->validate([
            'role_id'       => 'required',
            'nombres'       => 'required',
            'app'           => 'required',
            'apm'           => 'required',
            'email'         => 'required',
            'telefono'      => 'required',
            'rfc'           => 'required',
            'ciudad'        => 'required',
            'estado'        => 'required',
            'municipio'     => 'required',
            'cp'            => 'required',
            'colonia'       => 'required',
            'calle'         => 'required',
            'n_exterior'    => 'required',
            'nom_user'      => 'required',
            'password'      => 'required',

        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);//encriptamos la contraseña
        if(User::where('email', $data['email'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(User::where('telefono', $data['telefono'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(User::where('rfc', $data['rfc'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else if(User::where('nom_user', $data['nom_user'])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El nombre de usuario '.$request->all()['nom_user'].' ya ha sido registrado']);
        }else{
            try {
                $newUser = User::create($data);
                $datos = json_decode($data['datos']);
                for($i = 0; $i < sizeof($datos); $i++)
                {
                    $datos[$i]->user_id = $newUser->id;
                    $newAcceso = new Acceso();
                    $newAcceso->user_id = $datos[$i]->user_id;                  
                    $newAcceso->modulo_id = $datos[$i]->modulo_id;                  
                    $newAcceso->c = $datos[$i]->c;                   
                    $newAcceso->r = $datos[$i]->r;                   
                    $newAcceso->u = $datos[$i]->u;                   
                    $newAcceso->d = $datos[$i]->d; 
                    $newAcceso->save();               
                }
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Usuarios registrado']);
            } catch (\Exception $e) {
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el usuarios no fue registrado']);
            }
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'            => 'required',
            'role_id'       => 'required',
            'nombres'       => 'required',
            'app'           => 'required',
            'apm'           => 'required',
            'email'         => 'required',
            'telefono'      => 'required',
            'rfc'           => 'required',
            'ciudad'        => 'required',
            'estado'        => 'required',
            'municipio'     => 'required',
            'cp'            => 'required',
            'colonia'       => 'required',
            'calle'         => 'required',
            'n_exterior'    => 'required',
            'nom_user'      => 'required',
        ]);
        $usuarios = User::find($request->all()['id']);
        $data = $request->all();
        if(User::where([['email', $data['email']], ['id', '<>', $usuarios['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El correo '.$request->all()['email'].' ya ha sido registrado']);
        }else if(User::where([['telefono', $data['telefono']], ['id', '<>', $usuarios['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El telefóno '.$request->all()['telefono'].' ya ha sido registrado']);
        }else if(User::where([['rfc', $data['rfc']], ['id', '<>', $usuarios['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El RFC '.$request->all()['rfc'].' ya ha sido registrado']);
        }else if(User::where([['nom_user', $data['nom_user']], ['id', '<>', $usuarios['id']]])->exists()){
            return json_encode(['icon'  => 'warning', 'title'   => 'Advertencia', 'text'  => 'El nombre de usuario '.$request->all()['nom_user'].' ya ha sido registrado']);
        }else{
            try {
                $usuarios->update($data);
                $accesos = Acceso::where('user_id', $usuarios->id)->delete();//eliminamos los permisos
                $datos = json_decode($data['datos']);
                for($i = 0; $i < sizeof($datos); $i++)
                    {//recorremos los permisos y los asignamos
                        $datos[$i]->user_id = $usuarios->id;
                        $newAcceso = new Acceso();
                        $newAcceso->user_id = $datos[$i]->user_id;                  
                        $newAcceso->modulo_id = $datos[$i]->modulo_id;                  
                        $newAcceso->c = $datos[$i]->c;                   
                        $newAcceso->r = $datos[$i]->r;                   
                        $newAcceso->u = $datos[$i]->u;                   
                        $newAcceso->d = $datos[$i]->d; 
                        $newAcceso->save();               
                    }
                return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
            } catch (\Exception $e) {
                return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
            }
        }
    }
    public function delete($id)
    {
        try {
            User::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Usuario eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el usuario no fue eliminado']);
        }
    }
}
