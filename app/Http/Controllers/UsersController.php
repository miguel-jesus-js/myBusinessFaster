<?php

namespace App\Http\Controllers;

use App\Models\DireccionesEntrega;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\PersonasRequest;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\Hash;
use App\Traits\ImagesTrait;
use PDF;

class UsersController extends Controller
{
    use ImagesTrait;
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        $sucursal = $request->get('sucursal');
        $isAdmin = Auth::user()->isAdmin;
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $usuarios = User::with(['sucursal', 'persona', 'roles', 'persona.direcciones'])->withTrashed()->user($filtro)->isAdmin($isAdmin)->userSucursal($sucursal)->get();
                break;
            case 1:
                $usuarios = User::with(['sucursal', 'persona', 'roles', 'persona.direcciones'])->onlyTrashed()->user($filtro)->isAdmin($isAdmin)->userSucursal($sucursal)->get();
                break;
            case 2:
                $usuarios = User::with(['sucursal', 'persona', 'roles', 'persona.direcciones'])->whereNull('users.deleted_at')->user($filtro)->isAdmin($isAdmin)->userSucursal($sucursal)->get();
                break;
        }
        return json_encode($usuarios);
    }
    public function create(PersonasRequest $personasRequest, UsersRequest $userRequest)
    {
        $data = $personasRequest->all();
        if(!Auth::user()->is_admin)
        {
            $data = array_merge($data, ['sucursale_id' => Auth::user()->sucursal->id]);
        }
        $data['password'] = Hash::make($data['password']);//encriptamos la contraseña
        try {
            DB::beginTransaction();
            $persona = Persona::create($data);
            $data = array_merge($data, ['persona_id' => $persona->id]);
            User::create($data);
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
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Usuarios registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el usuarios no fue registrado']);
        }
    }
    public function update(PersonasRequest $personaRequest, UsersRequest $userRequest)
    {
        $data = $personaRequest->all();
        $persona = Persona::find($data['id']);
        $usuario = User::find($data['cliente_id']);
        $data['foto_perfil'] = $this->uploadImagen($personaRequest->file('foto_perfil'), '0', 'img/usuarios/');
        if($data['foto_perfil'] == null)
        {
            unset($data['foto_perfil']);
        }else{
            $usuario->foto_perfil = $data['foto_perfil'];
            if($usuario->foto_perfil != 'avatar.png'){

                $this->deleteImagen('img/usuarios/', $usuario->foto_perfil);
            }
        }
        if(isset($data['password'])){
            $data['password'] = Hash::make($data['password']);//encriptamos la contraseña
        }
        if($data['password'] == null || $data['password'] == ''){
            unset($data['password']);
        }
        try {
            DB::beginTransaction();
            $usuario->update($data);
            $persona->update($data);
            if(isset($data['ciudad']))
            {
                for($i = 0; $i < sizeof($data['ciudad']); $i++)
                {
                    $dataDirecc = [
                        'persona_id'      => $usuario->persona_id, 
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
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
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
    public function downloadPlantilla()
    {
        $file = public_path('assets/plantillas/plantilla_empleados.xlsx');
        return response()->file($file);
    }
    public function uploadUsuario(UploadRequest $request)
    {
        try {
            $file = $request->file('archivo');
            Excel::import(new UsersImport, $file);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Empleados registrados']);
        } catch (\Exception $e) {
            dd($e);
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, los empleados no fueron registrados']);
        }
    }
    public function exportarPDF()
    {
        $empleados = User::with(['sucursal', 'persona', 'roles'])->whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.empleados_pdf', ['empleados' => $empleados, 'esExcel' => false]);
        return $pdf->download('Empleados.pdf');
    }
    public function exportarExcel()
    {
        return Excel::download(new UsersExport, 'Empleados.xlsx');
    }
}
