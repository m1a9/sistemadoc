<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocide extends Model
{
    protected $table = 'Tipodocide';
    protected $fillable = ['name','borrado'];
	protected $guarded = ['id'];
}

