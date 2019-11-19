<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuariosRequest extends FormRequest
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
        $rules = [
            'rut' => 'required|min:12|max:13|unique:users,rut,'.$this->id,
            'nombre' => 'required|min:3|max:50',
            'a_paterno' => 'required|min:3|max:50',
            'a_materno' => 'required|min:3|max:50',
            'email' => 'required|min:12|email|unique:users,email,'.$this->id,
            'nickname' => 'required|min:3|max:20|unique:users,nickname,'.$this->id,            
            'direccion' => 'required|min:5|max:255',
            'rol_id' => 'required|exists:roles',
            'id_ciudad' => 'required|exists:roles',            
        ];

        if($this->method() == 'POST')
        {
            $rules += [
            'password' => 'required|required_with:confirm_password|same:confirm_password|min:3|max:20|',
            'confirm_password' => 'required|min:3|max:20'
            ];
        }else{
            $rules += [
                'password' => 'nullable|required_with:confirm_password|same:confirm_password|min:3|max:20|',
                'confirm_password' => 'nullable|min:3|max:20'
            ];
        }

        return $rules;
    }
}
