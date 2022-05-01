<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    public function tipousuarios(){
        return $this->belongsTo('App\Tipousuario');
    }

    public function personas(){
        return $this->belongsTo('App\Persona');
    }

    // public function setPasswordAttribute($password){
    //     $this->attributes['password']= bcsqrt($password);
    // }
}
