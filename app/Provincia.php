<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;

    static $rules = [
		'departamentos_id' => 'required',
		'name' => 'required',
    ];

    protected $fillable = ['departamentos_id','name'];

    // public function departamento()
    // {
    //     return $this->hasOne(Departamento::class,'id','departamentos_id');
    // }

    public function departamentos()
    {
       return $this->belongsTo('App\Departamento');

    }

    public function distritos(){
      return $this->hasMany('App\Distrito');
   }
}



