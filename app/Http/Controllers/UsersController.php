<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\User;
use App\Imports\UsersImport;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UploadRequest;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $usuarios = User::withTrashed()->user($filtro)->get();
                break;
            case 1:
                $usuarios = User::onlyTrashed()->user($filtro)->get();
                break;
            case 2:
                $usuarios = User::whereNull('deleted_at')->user($filtro)->get();
                break;
        }
        return json_encode($usuarios);
    }
    public function create(UsersRequest $request)
    {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);//encriptamos la contraseña
        try {
            $newUser = User::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Usuarios registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el usuarios no fue registrado']);
        }
    }
    public function update(UsersRequest $request)
    {
        $usuarios = User::find($request->all()['id']);
        $data = $request->all();
        try {
            $usuarios->update($data);
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
        $empleados = User::whereNull('deleted_at')->get();
        $pdf = Pdf::loadView('pdf.empleados_pdf', ['empleados' => $empleados])->setPaper('a4', 'landscape');
        return $pdf->download('Empleados.pdf');
    }
    public function exportarExcel(Request $request)
    {
        return Excel::download(new UsersExport, 'Proveedores.xlsx');
    }
}
