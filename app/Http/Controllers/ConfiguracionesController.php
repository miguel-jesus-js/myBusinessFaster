<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Configuracione;
use App\Http\Controllers\ProductosController;
use App\Traits\ImagesTrait;


class ConfiguracionesController extends Controller
{
    use ImagesTrait;
    public function settings()
    {
        $settings = Configuracione::all();
        return json_encode($settings);
    }
    public function update(Request $request)
    {
        $settings = Configuracione::find(1);
        $data = $request->all();
        isset($data['mostrar_sidebar']) ? $data['mostrar_sidebar']  = $request->filled('mostrar_sidebar') : '';
        isset($data['mostrar_banner'])  ? $data['mostrar_banner']   = $request->filled('mostrar_banner') : '';
        isset($data['mostrar_foto'])    ? $data['mostrar_foto']     = $request->filled('mostrar_foto') : '';
        $data['logotipo'] = $this->uploadImagen($request->file('logotipo'), 'logotipo', 'img/');
        if($data['logotipo'] == null){
            unset($data['logotipo']);
        }else{
            $this->deleteImagen($settings->logotipo, 'img/');
        }
        try{
            $settings->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Configuraciones actualizadas']);
        }catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las configuraciones no fueron actualizadas']);
        }

    }
}
