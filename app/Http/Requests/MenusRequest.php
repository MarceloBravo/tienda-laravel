<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenusRequest extends FormRequest
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
            'nombre' => 'required|min:3|max:50|unique:menus,nombre,'.$this->menu,
            'icono_class' => 'max:15',
            'menu_padre_id' => 'exists:menus,id',
            'pantalla_id' => 'exists:pantallas,id',
            'posicion' => 'integer|min:1'
         ];
    }

    public function messages()
    {
        return  [
            'nombre.required' => 'Debes ingresar el nombre del menú.',
            'icono_class.max' => 'El código del icono no debe sobrepasar los 15 carácteres. Ingresa un código más corto.' ,
            'menu_padre_id.exists' => 'El menú padre no es válido o no existe.',
            'pantalla_id.exists' => 'La pantalla seleccionada no es válida o no existe.',
            'posicion.integer' => 'La posición ingresada no es un número entero.',
            'posicion.min' => 'El número ingresado debe ser un valor ´positivo.',
        ];
    }
}
