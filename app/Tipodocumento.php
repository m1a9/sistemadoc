<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    protected $table = 'tipodocumentos';
    protected $fillable = ['name','borrado'];
	protected $guarded = ['id'];
}
