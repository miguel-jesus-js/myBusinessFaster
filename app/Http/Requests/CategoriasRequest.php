<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriasRequest extends FormRequest
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
            'categoria' => 'required|min:3|max:30|regex:/^[\pL\s]+$/u'
        ];
    }
    public function messages()
    {
        return [
            'categoria.required' => 'Escribe alguna categoria',
            'categoria.min' => 'La categoria debe tener mínimo 3 caracteres',
            'categoria.max' => 'La categoria debe tener máximo 30 caracteres',
            'categoria.regex' => 'La categoria debe ser letras sin caracteres especiales',
        ];
    }
}
