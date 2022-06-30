<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materiale;

class MaterialesController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $materiales = Materiale::withTrashed()->get();
                break;
            case 1:
                $materiales = Materiale::onlyTrashed()->get();
                break;
            case 2:
                $materiales = Materiale::whereNull('deleted_at')->get();
                break;
            default:
                $materiales = Materiale::where('material', 'like', '%'.$filtro.'%')->get();
                break;
        }
        return json_encode($materiales);
    }
    public function create(Request $request)
    {
        $request->validate([
            'material'       => 'required',
        ]);
        $data = $request->all();
        try {
            Materiale::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Material registrado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, el material no fue registrado']);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'          => 'required',
            'material'       => 'required',
        ]);
        $material = Materiale::find($request->all()['id']);
        $data = $request->all();
        try {
            $material->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            Materiale::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Material eliminado']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error el material no fue eliminado']);
        }
    }
}
