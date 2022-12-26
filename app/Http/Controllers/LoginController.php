<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function session(LoginRequest $request)
    {
        $data = $request->all();
        if(Auth::attempt($data, $request->filled('remember')))
        {
            return json_encode(['icon'  => 'success', 'title'   => 'Exitó', 'text'  => 'Bienvenido']);
        }
        return json_encode(['icon'  => 'error', 'title'   => 'Error', 'text'  => 'Credenciales invalidas']);
    }
}
