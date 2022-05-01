<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipousuario extends Model
{
    protected $table = 'tipousuarios';
    protected $fillable = ['name','borrado'];
	protected $guarded = ['id'];

    public function users(){
        return $this->hasMany('App\User');
    }

}
