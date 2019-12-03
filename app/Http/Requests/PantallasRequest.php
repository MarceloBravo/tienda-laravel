<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PantallasRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:pantallas,nombre,'.$this->pantalla,
            'permite_crear' => 'required|integer',
            'permite_actualizar' => 'required|integer',
            'permite_eliminar' => 'required|integer',
            'tabla' => 'required|min:3|max:50'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Debes ingresar el nombre.',
            'nombre.min' => 'El nombre debe tener almenos 3 carácteres. Ingresa un nombre más largo',
            'nombre.max' => 'El nombre debe tener hasta 50 carácteres. Ingresa un nombre más corto',
            'nombre.unique' => 'El nombre ingresado ya está en uso. Ingresa un nombre diferente.',

            'permite_crear.required' => 'El campo <b>Permite Crear</b> es obligatorio.',
            'permite_crear.integer' => 'El valor del campo <b>Permite Crear</b> no está permitido.',

            'permite_actualizar.required' => 'El campo <b>Permite Actualizar</b> es obligatorio.',
            'permite_actualizar.integer' => 'El valor del campo <b>Permite Actualizar</b> no está permitido.',

            'permite_eliminar.required' => 'El campo <b>Permite Eliminar</b> es obligatorio.',
            'permite_eliminar.integer' => 'El valor del campo <b>Permite Eliminar</b> no está permitido.',

            'nombre.required' => 'Debes ingresar el nombre de la tabla asociada a la pantalla. En caso de no tener tabla asociada ingresa el nombre de la pantalla.',
            'nombre.min' => 'El nombre de la tabla debe tener almenos 3 carácteres. Ingresa un nombre más largo',
            'nombre.max' => 'El nombre de la tabla debe tener hasta 50 carácteres. Ingresa un nombre más corto',
        ];
    }
}
