<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Locales;
use DB;
use Validator;

class DocumentoController extends Controller{
	public function index1(){
		return view('documento.index');
	}
}
