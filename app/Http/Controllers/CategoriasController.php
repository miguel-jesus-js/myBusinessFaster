<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriasController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $categorias = Categoria::withTrashed()->get();
                break;
            case 1:
                $categorias = Categoria::onlyTrashed()->get();
                break;
            case 2:
                $categorias = Categoria::whereNull('deleted_at')->get();
                break;
            default:
                $categorias = Categoria::where('categoria', 'like', '%'.$filtro.'%')->get();
                break;
        }
        return json_encode($categorias);
    }
    public function create(Request $request)
    {
        $request->validate([
            'categoria'       => 'required',
        ]);
        $data = $request->all();
        try {
            Categoria::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Categoria registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la Categoria no fue registrada']);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'required',
            'categoria'       => 'required',
        ]);
        $categorias = Categoria::find($request->all()['id']);
        $data = $request->all();
        try {
            $categorias->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Categoria::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Categoria eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la Categoria no fue eliminada']);
        }
    }
}
