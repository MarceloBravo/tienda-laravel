<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaisesRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:paises,nombre,'.$this->pais
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre del pais es obligatorio.',
            'nombre.min' => 'El nombre del pais debe tener almenos 3 carácteres. Ingrese un nombre mas largo.',
            'nombre.max' => 'El nombre del pais no debe sobrepasar los 50 carácteres. Ingrese un nombre mas corto.',
            'nombre.unique' => 'El nombre del pais ya se encuentra en uso. Ingrese un nombre diferente.'
        ];
    }
}
