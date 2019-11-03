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
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:5|max:100|unique:categorias,nombre,'.$this->categoria,    //No lleva  $this->id sino que $this->categoria ya que se está utilizando inyección de dependencias en route/web.php
            'descripcion' => 'required|min:10|max:500'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la categoría es obligatorio.',
            'nombre.min' => 'El nombre de la categoría debe tener un mínimo de 5 carácteres.',
            'nombre.max' => 'El nombre de la categoría debe tener menos de 100 carácteres.',
            'nombre.unique' => 'El nombre de la categoría ya está en uso. Ingresa un nombre diferente.',

            'descripcion.required' => 'La descripción de la categoría es obligatoria.',
            'descripcion.min' => 'La descripción debe tener almenos 10 carácteres.',
            'descripcion.max' => 'La descripción debe tener menos de 500 carácteres. Ingresa un descripción más breve.',
        ];
    }
}
