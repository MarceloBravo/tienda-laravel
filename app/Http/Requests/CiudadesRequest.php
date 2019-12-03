<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiudadesRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:ciudades,nombre,'.$this->ciudade,
            'id_comuna' => 'required|exists:comunas,id'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la ciudad es obligatorio.',
            'nombre.min' => 'El nombre de la ciudad debe tener almenos 3 carácteres. Ingresa un nombre mas largo.',
            'nombre.max' => 'El nombre de la ciudad debe tener un máximo de 50 carácteres. Ingresa un nombre mas corto.',
            'nombre.unique' => 'El n ombre de la ciudad ya se encuentra en la base de datos. Ingresa un nombre diferente.',

            'id_comuna.required' => 'Debes seleccionar una comuna.',
            'id_comuna.exits' => 'La comuna seleccionad no es válida. Selecciona una comuna de la lista de comunas.'
        ];
    }
}
