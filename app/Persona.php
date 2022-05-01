<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;
    public function personas(){
        return $this->hasMany('App\User');
    }

    public function tipodocide(){
        return $this->belongsTo('App\Tipodocide');
    }
}
