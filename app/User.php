<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rut', 'nombre', 'a_paterno', 'a_materno','email', 'nickname','password', 'activo', 'direccion', 'id_ciudad', 'rol_id', 'fono'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Relación uno a muchos
    public function ordenes(){
        return $this->hasMany('App\Orden');
    }

    //Relación muchos a uno (relación de uno a muchos de inverso a roles)
    public function rol(){
       return $this->belongsTo('App\Rol');
    }

    public function ciudad()
    {
        return $this->hasOne('App\Ciudad','id','id_ciudad');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
