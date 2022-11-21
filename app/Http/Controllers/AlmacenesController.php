<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacene;

class AlmacenesController extends Controller
{
    public function index(Request $request, $tipo)
    {
        $filtro = $request->get('filtro');
        // 0 todo - 1 eliminados - 2 no eliminados
        switch ($tipo){
            case 0:
                $almacenes = Almacene::withTrashed()->almacen($filtro)->get();
                break;
            case 1:
                $almacenes = Almacene::onlyTrashed()->almacen($filtro)->get();
                break;
            case 2:
                $almacenes = Almacene::whereNull('deleted_at')->almacen($filtro)->get();
                break;
        }
        return json_encode($almacenes);
    }
}
