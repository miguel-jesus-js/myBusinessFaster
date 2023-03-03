<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Configuracione;
use App\Models\Sucursale;
use App\Models\User;
use App\Http\Controllers\ProductosController;
use App\Traits\ImagesTrait;


class ConfiguracionesController extends Controller
{
    use ImagesTrait;
    public function settings()
    {
        $settings = Configuracione::find(1);
        $sucursal = Sucursale::where('user_id', Auth::user()->id)->first();
        $info = User::find(Auth::user()->id);
        return json_encode(['settings' => $settings, 'sucursal' => $sucursal, 'info' => $info]);
    }
    public function update(Request $request)
    {
        $data = $request->all();
        $sucursal = Sucursale::where('user_id', Auth::user()->id)->first();
        $settings = Configuracione::find(1);
        $data['logotipo'] = $this->uploadImagen($request->file('logotipo'), 'logotipo', 'img/');
        if($data['logotipo'] == null){
            unset($data['logotipo']);
        }else{
            $this->deleteImagen($settings->logotipo, 'img/');
        }
        try{
            $sucursal->update($data);
            $settings->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Configuraciones actualizadas']);
        }catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las configuraciones no fueron actualizadas']);
        }
        
    }
    public function updateSettingsUser(Request $request)
    {
        $data = $request->all();
        $settings = Configuracione::find(1);
        $user = User::find(Auth::user()->id);
        $data = array_merge($data, ['mostrar_sidebar' => $request->filled('mostrar_sidebar')]);
        $data = array_merge($data, ['mostrar_banner' => $request->filled('mostrar_banner')]);
        $data = array_merge($data, ['mostrar_foto' => $request->filled('mostrar_foto')]);
        try{
            $settings->update($data);
            $user->update($data);
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Configuraciones actualizadas']);
        }catch(\Exception $e){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Ocurrio un error, las configuraciones no fueron actualizadas']);
        }
    }
}
