<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
            'categoria_id' => 'required|exists:categorias,id',
            'nombre' => 'required|min:5|max:150',
            'descripcion' => 'required',
            'resumen' => 'required|min:10|max:300',
            'precio' => 'required|integer',
            'precio_anterior' => 'required|integer',
            'visible' => 'integer',
            'color' => 'required|min:3|max:20',
            'nuevo' => 'integer',
            'oferta' => 'integer',
            'imagen_predeterminada' => 'required',
            'imagenes' => 'one_of:imagenes_id' // one_of no es una regla de validación de laravel, sino que es una regla de validación personal ver app\provider\MyValidatior.php. Fue creada con el comando "php artisan make:provider MyValidator" y valida que uno de los 2 campos o los 2 esté ingresados (imagenes y/o imagenes_id)
        ];
    }

    public function messages()
    {
        return [
            'categoria_id.required' => 'Debe seleccionar una categoría.',
            'categoria_id.exists' => 'La categoría seleccionada no exsite.',
            'nombre.required' => 'El campo nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener un mínimo de 5 carácteres. Ingrese un  nombre más largo.',
            'nombre.max' => 'El nombre debe tener un máximo de 150 carácteres. Ingrese un nombre más corto.',
            'descripcion.required' => 'Debe ingresar la descripción del producto.',
            'resumen.required' => 'Debe ingresar un resumen de la descripción del producto.',
            'resumen.min' => 'El resumen debe tener un mínimo de 10 carácteres. Ingrese un resumen más extenso.',
            'resumen.max' => 'El resumen debe tener un máximo de 300 carácteres. Ingrese un resumen más breve.',
            'precio.required' => 'Debe ingresar el precio del producto.',
            'precio.integer' => 'El precio del producto no debe contener decimales. Infrese sólo números enteros',
            'precio_anterior.required' => 'Debe ingresar el precio anterior del producto. En su defecto ingrese cero (0).',
            'precio_anterior.integer' => 'El precio anterior del producto no debe contener decimales. Infrese sólo números enteros',
            'visible.integer' => 'El valor para el campo visible no es válido.',
            'color.required' => 'Debe ingresar el color del producto.',
            'color.min' => 'El nombre del color es muy corto. Ingrese un mínimo de 3 carácteres.',
            'color.max' => 'El nombre del color es muy largo, Ingrese un máximo de 20 carácteres.',
            'nuevo.integer' => 'El valor para el campo nuevo no es válido.',
            'oferta.integer' => 'El valor para el campo oferta no es válido.',
            'imagen_predeterminada.required' => 'Debe seleccionar la imágen por defecto (o imágen principal) del producto.',
            'imagenes.one_of' => 'Debe seleccionar almenos una imágen para el producto.',
        ];
    }
}
