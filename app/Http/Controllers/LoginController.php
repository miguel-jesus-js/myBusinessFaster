<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;

class LoginController extends Controller
{
    public function session(Request $request)
    {
        $data = $request->all();
        $persona = Persona::where('email', $data['email'])->first();
        if(!$persona){
            return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'El correo no existe']);
        }
        if(Auth::attempt(['persona_id' => $persona->id, 'password' => $data['password']]))
        {
            $request->session()->regenerate();
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Bienvenido']);
        }
        return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Credenciales invalidas']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->regenerate();
        return \redirect('/');
    }
}
