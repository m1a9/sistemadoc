<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiposolicitante extends Model
{
    protected $table = 'tiposolicitantes';
    protected $fillable = ['name','borrado'];
	protected $guarded = ['id'];
}
