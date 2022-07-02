<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UnidadMedida;

class UnidadMedidasController extends Controller
{
    public function index($filtro)
    {
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($filtro){
            case 0:
                $unidad_medias = UnidadMedida::withTrashed()->get();
                break;
            case 1:
                $unidad_medias = UnidadMedida::onlyTrashed()->get();
                break;
            case 2:
                $unidad_medias = UnidadMedida::whereNull('deleted_at')->get();
                break;
            default:
                $unidad_medias = UnidadMedida::where('unidad_medida', 'like', '%'.$filtro.'%')->get();
                break;
        }
        return json_encode($unidad_medias);
    }
    public function create(Request $request)
    {
        $request->validate([
            'unidad_medida'       => 'required',
        ]);
        $data = $request->all();
        try {
            UnidadMedida::create($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Unidad de medida registrada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, la unidad de medida no fue registrada']);
        }
    }
    public function update(Request $request)
    {
        $request->validate([
            'id'                    => 'required',
            'unidad_medida'         => 'required',
        ]);
        $unidad_medidas = UnidadMedida::find($request->all()['id']);
        $data = $request->all();
        try {
            $unidad_medidas->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Datos actualizados']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error los datos no fueron actualizados']);
        }
    }
    public function delete($id)
    {
        try {
            UnidadMedida::find($id)->delete();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Unidad de medida eliminada']);
        } catch (\Exception $e) {
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error la unidad de medida no fue eliminada']);
        }
    }
}
