<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;

class ModulosController extends Controller
{
    public function index(){
        $modulos = Modulo::with('permisos')->get();
        return json_encode($modulos);
    }
}
