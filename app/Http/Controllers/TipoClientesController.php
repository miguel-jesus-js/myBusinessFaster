<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoCliente;

class TipoClientesController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $tipo_clientes = TipoCliente::withTrashed()->get();
                break;
            case 1:
                $tipo_clientes = TipoCliente::onlyTrashed()->get();
                break;
            case 2:
                $tipo_clientes = TipoCliente::whereNull('deleted_at')->get();
                break;
            default:
                $tipo_clientes = TipoCliente::where('tipo_cliente', 'like', '%'.$filtro.'%')->get();
                break;
        }
        return json_encode($tipo_clientes);
    }
    public function create(Request $request)
    {
        $request->validate([
            'tipo_cliente'       => 'required',
        ]);
        $data = $request->all();
        try {
            TipoCliente::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de cliente registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el tipo de cliente no fue registrado']);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'required',
            'tipo_cliente'       => 'required',
        ]);
        $tipo_clientes = TipoCliente::find($request->all()['id']);
        $data = $request->all();
        try {
            $tipo_clientes->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            TipoCliente::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Tipo de cliente eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el tipo de cliente no fue eliminado']);
        }
    }
}
