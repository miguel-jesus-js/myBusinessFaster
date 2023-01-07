<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracione;

class ConfiguracionesController extends Controller
{
    public function settings()
    {
        $settings = Configuracione::all();
        return json_encode($settings);
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $data['mostrar_sidebar']    = $request->filled('mostrar_sidebar');
        $data['mostrar_banner']     = $request->filled('mostrar_banner');
        $data['mostrar_foto']       = $request->filled('mostrar_foto');
        $settings = Configuracione::find(1);
        try{
            $settings->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Configuraciones actualizadas']);
        }catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las configuraciones no fueron actualizadas']);
        }

    }
}
