<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegionesRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:regiones,nombre,'.$this->regione,
            'id_pais' => 'required|exists:paises,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener un mínimo de 3 carácteres. Ingrese un nombre más largo.',
            'nombre.max' => 'El nombre debe tener un máximo de 50 carácteres. Ingrese un nombre más corto.',
            'nombre.unique' => 'El nombre ya se encuentra en uso. Ingrese un nombre diferente.',

            'id_pais.required' => 'Debe seleccionar el pais al cual pertenece la región.',
            'id_pais.exists' => 'El pais seleccionado no es válido. Debe seleccionar un país de la lista de paises.'
        ];
    }
}
