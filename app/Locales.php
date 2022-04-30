<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Locales extends Model
{
    protected $table = 'locales';
    protected $fillable = ['name','direccion','distritos_id'];
	protected $guarded = ['id'];
}