<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipodocide;
use Validator;

class TipodocideController extends Controller{
	public function index1(){
		return view('tipodocide.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $tipodoc=Tipodocide::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $tipodoc->total(),
                'current_page'=> $tipodoc->currentPage(),
                'per_page'=> $tipodoc->perPage(),
                'last_page'=> $tipodoc->lastPage(),
                'from'=> $tipodoc->firstItem(),
                'to'=> $tipodoc->lastItem(),
            ],
            'tipodoc'=>$tipodoc
        ];	
    }
    public function store(Request $request){
        $nom=$request->cate;
        $result='1';
        $msj='';
        $exi='';
        $selector='';
        $input  = array('nom' => $nom);
        $reglas = array('nom' => 'required');

        $input1  = array('nom' => $nom);
        $regla1 = array('nom' => 'unique:tipodocide,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese un tipo de documento de identidad';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='El tipo de documento de identidad ya existe'; 
            }else{
                $exi='1';
                $Tipodoc = new Tipodocide();
                $Tipodoc->name=$nom;
                $Tipodoc->borrado='0';
                $Tipodoc->save();
                $msj='El tipo de documento de identidad se registró con éxito';
            }
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
    public function update(Request $request, $id){
        $newcat=$request->newcat;
        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';
        if ($tipo=="editar") {
            if (strlen(trim($newcat))>0) {
                $band=Tipodocide::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='El tipo de documento de identidad ya existe';       
                }else{
                    $exi='1';
                    $Tipodoc =Tipodocide::findOrFail($id);
                    $Tipodoc->name=$newcat;
                    $Tipodoc->borrado='0';
                    $Tipodoc->save();
                    $msj='El tipo de documento de identidad se actualizó';
                }
            }else{
                $result='0';
                $msj='Ingrese un tipo de documento de identidad';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Tipodoc =Tipodocide::findOrFail($id);
            $Tipodoc->borrado='1';
            $Tipodoc->save();
            $msj='El tipo de documento se eliminó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
