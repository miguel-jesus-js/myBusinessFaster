<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modulo;

class ModulosController extends Controller
{
    public function index(){
        $modulos = Modulo::all();
        return json_encode($modulos);
    }
}
