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
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:2|max:50|unique:marcas,nombre,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener un mínimo de 2 carácteres.',
            'nombre.max' => 'El nombre no pudede sobrepasar los 50 carácteres. Ingrese un nombre más corto.',
            'nombre.unique' => 'El nombre ya se encuentra en uso. Ingrese un nombre diferente.'
        ];
    }
}
