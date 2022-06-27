<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Marca;

class MarcasController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $marcas = Marca::withTrashed()->get();
                break;
            case 1:
                $marcas = Marca::onlyTrashed()->get();
                break;
            case 2:
                $marcas = Marca::whereNull('deleted_at')->get();
                break;
            default:
                $marcas = Marca::where('marca', 'like', '%'.$filtro.'%')->get();
                break;
        }
        return json_encode($marcas);
    }
    public function create(Request $request)
    {
        $request->validate([
            'marca'       => 'required',
        ]);
        $data = $request->all();
        try {
            Marca::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marca registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la marca no fue registrada']);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'required',
            'marca'       => 'required',
        ]);
        $marcas = Marca::find($request->all()['id']);
        $data = $request->all();
        try {
            $marcas->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Marca::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Marca eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la marca no fue eliminada']);
        }
    }
}
