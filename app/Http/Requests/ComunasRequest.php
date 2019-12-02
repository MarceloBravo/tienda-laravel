<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComunasRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:comunas,nombre,'.$this->comuna,
            'id_region' => 'required|exists:regiones,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la comuna es obligatorio.',
            'nombre.min' => 'El nombre de la comuna debe tener un mínimo de 3 carácteres. Ingresa un nombre mas largo.',
            'nombre.max' => 'El nombre de la comuna debe tener un máximo de 50 carácteres. Ingresa un nombre mas corto.',
            'nombre.unique' => 'El nombre da la comina ya existe. Ingresa un nombre distinto.',

            'id_regioin.required' => 'Debes seleccionar una región.',
            'id_region.exists' => 'La región seleccionada no es válida. Selecciona una región de la lista de regiones.'
        ];
    }
}
