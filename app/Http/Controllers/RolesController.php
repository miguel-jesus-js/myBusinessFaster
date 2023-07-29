<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        $roles = Role::rol($filtro)->get();
        return json_encode($roles);
    }

    public function create(Request $request)
    {
        $data = $request->all();
        try{
            $rol = Role::create($data);
            $rol->syncPermissions(json_decode('['.$data['permisos'].']'));
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Rol registrado']);
        } catch(Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el rol no fue registrado']);
        }

    }
}
