<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstadosRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            "nombre" => "required|min:3|max:50|unique:estados,nombre,".$this->estado
        ];
    }

    public function messages()
    {
        return [
            "nombre.required" => "El campo nombre es obligatorio.",
            "nombre.min" => "El nombre debe tener un mínimo de 3 carácteres. Ingresa un nombre más largo.",
            "nombre.max" => "El nombre debe tener un máximo de 50 carácteres. Ingresa un nombre más corto.",
            "nombre.unique" => "El nombre ya se encuentra en uso. Ingresa un nombre diferente."
        ];
    }
}
