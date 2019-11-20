<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Validator\Validator;

class MyValidator extends validator
{
    
    //Valida que el campo a validar ($value) o el campo a comparar ($this->getValue($parameters[0])) 
    //contengan datos ya sea ambos o uno de los 2
    //creada con el comando "php artisan make:provider MyValidator"
    public function validateOneOf($attribute, $value, $parameters)
    {
        if(is_null($value) || is_null($this->getValue($parameters[0]))){
            $resp = false;
        }elseif(is_null($value)){
            $resp = $this->getValue($parameters[0]) != '';
        }else{
            $resp = $value != '';
        }

        return $resp;
    }
}
