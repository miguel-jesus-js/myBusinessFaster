<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductosUploadRequest extends FormRequest
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
            'archivo' => 'required|mimes:xlsx,xls,csv|max:5120'
        ];
    }
    public function messages()
    {
        return [
            'archivo.required' => 'Debe cargar un achivo de excel',
            'archivo.mimes' => 'El archivo no es un formato de excel',
            'archivo.max' => 'El archivo no debe ser mayor a 5MB',
        ];
    }
}
