<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
        $rules = [
            'sucursale_id'  => 'required|numeric|exists:sucursales,id',
            'role_id'       => 'required|numeric|exists:roles,id',
            'nom_user'      => 'required|min:5|max:20|unique:users,nom_user,'.$this->cliente_id,
            'password'      => isset($this->id) ? 'nullable' : 'required'.'|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_=+-]).{8,20}$/',
        ];
        if($this->user()->is_admin)
        {
            $rules['sucursale_id']  = 'required|numeric|exists:sucursales,id';
        }
        return $rules;
    }
    public function messages()
    {
        return [
            'sucursale_id.required' => 'Seleccione una sucursal',
            'sucursale_id.numeric'  => 'La sucursal de debe ser un número',
            'sucursale_id.exists'   => 'La sucursal no coincide con las sucursal de la base de datos',
            'role_id.required'      => 'Seleccione un rol',
            'role_id.numeric'       => 'El rol de debe ser un número',
            'role_id.exists'        => 'El rol no coincide con los roles de la base de datos',
            'nom_user.required'     => 'Escribe algún nombre de usuario',
            'nom_user.min'          => 'El nombre de usuario debe tener mínimo 5 caracteres',
            'nom_user.max'          => 'El nombre de usuario debe tener máximo 20 caracteres',
            'nom_user.unique'       => 'El nombre de usuario ya existe',
            'password.required'     => 'Escribe alguna contraseña',
            'password.regex'        => 'La contraseña debe tener entre 8 a 20 caracteres, una letra mayuscula, minuscula, un numero y un caracter especial',
        ];
    }
}
