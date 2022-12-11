<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CaracteristicasTableRequest extends FormRequest
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
            'caracteristica'            => 'required|array|min:1',
            'caracteristica.*'          => 'required|min:5|max:100|regex:/^[a-zA-ZÁÉÍÓÚáéíóúÑñ0-9,.!? ]*$/',
        ];
    }
    public function messages()
    {
        return [
            'caracteristica.required'       => 'Escribe alguna característica',
            'caracteristica.*.min'          => 'La característica debe tener mínimo 5 caracteres',
            'caracteristica.*.max'          => 'La característica debe tener máximo 100 caracteres',
            'caracteristica.*.regex'        => 'La característica debe ser letras sin caracteres especiales',
        ];
    }
}
