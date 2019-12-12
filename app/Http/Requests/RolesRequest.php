<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:roles,id'.$this->id,
            'descripcion' => 'required|min:10|max:255'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debes ingresar el nombre del rol.',
            'nombre.min' => 'El nombre del rol debe tener almenos 3 carácteres. Ingresa un nombre más largo.',
            'nombre.max' => 'El nombre del rol debe tener un máximo de 50 carácteres. Ingresa un nombre más corto.',
            'nombre.unique' => 'El nombre de rol ya se encuentra en uso. Ingresa un nombre diferente.',

            'descripcion.required' => 'La descripción del rol es obligatoria.',
            'descripcion.min' => 'La descripción del rol debe tener un mínimo de 10 carácteres. Ingresa un nombre más largo.',
            'descripcion.max' => 'La descripción del rol no debe superar los 255 carácteres. Ingresa un nombre más corto.'
        ];
    }
}
