<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
   protected $table = 'departamentos';
   protected $fillable = ['name','updated_at','created_at'];
	protected $guarded = ['id'];

    public function paises()
    {
       return $this->belongsTo('App\Paise');

    }
    public function provincias(){
      return $this->hasMany('App\Provincia');
   }

}
