<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $table = 'areas';
    protected $fillable = ['name','sigla', 'telefono', 'anexo', 'correo', 'locales_id', 'areas_id'];
	protected $guarded = ['id'];
}