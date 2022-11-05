<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcasRequest extends FormRequest
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
            'marca' => 'required|min:3|max:30|regex:/^[\pL\s]+$/u',
        ];
    }

    public function messages()
    {
        return [
            'marca.required' => 'Escribe alguna marca',
            'marca.min' => 'La marca debe tener mínimo 3 caracteres',
            'marca.max' => 'La marca debe tener máximo 30 caracteres',
            'marca.regex' => 'La marca debe ser letras sin caracteres especiales',
        ];
    }
}
