<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DireccionesEntregasRequest;
use App\Http\Requests\DireccionesEntregaTableRequest;

class DireccionesEntregasController extends Controller
{
    public function create (DireccionesEntregasRequest $request)
    {

    }
    public function createTable (DireccionesEntregaTableRequest $request)
    {
        try{

        }catch(\Exception $e){
            dd($e);
        }
    }
}
