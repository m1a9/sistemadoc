<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    protected $table = 'paises';
    protected $fillable = ['name','borrado','created_at','updated_at'];
	protected $guarded = ['id'];
   
    public function departamentos(){
       return $this->hasMany('App\Departamento');
    }
}
