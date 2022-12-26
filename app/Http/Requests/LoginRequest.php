<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'email'     => 'required|min:11|max:100|email',
            'password'  => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,15}$/'
        ];
    }
    public function messages()
    {
        return [
            'email.required'        => 'El correo es requerido',
            'email.min'             => 'El correo debe tener miníno 11 caracteres',
            'email.max'             => 'El correo debe tener máximo 100 caracteres',
            'email.email'           => 'El correo no tiene un formato valido',
            'password.required'     => 'La contraseña es requerida',
            'password.regex'        => 'La contraseña debe tener entre 8 a 15 caracteres, una letra mayuscula, minuscula, un numero y un caracter especial',
        ];
    }
}
