<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tiposolicitante;
use Validator;

class TiposolicitanteController extends Controller{
	public function index1(){
		return view('tiposolicitante.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $tiposolicitantes=Tiposolicitante::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $tiposolicitantes->total(),
                'current_page'=> $tiposolicitantes->currentPage(),
                'per_page'=> $tiposolicitantes->perPage(),
                'last_page'=> $tiposolicitantes->lastPage(),
                'from'=> $tiposolicitantes->firstItem(),
                'to'=> $tiposolicitantes->lastItem(),
            ],
            'tiposolicitantes'=>$tiposolicitantes
        ];	
    }
    public function store(Request $request){
        $nom=$request->cate;
        $result='1';
        $msj='hola';
        $exi='';
        $selector='';
        $input  = array('nom' => $nom);
        $reglas = array('nom' => 'required');

        $input1  = array('nom' => $nom);
        $regla1 = array('nom' => 'unique:tiposolicitantes,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese un tipo de solicitante';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='El tipo de solicitante ya existe'; 
            }else{
                $exi='1';
                $Tiposolicitante = new Tiposolicitante();
                $Tiposolicitante->name=$nom;
                $Tiposolicitante->borrado='0';
                $Tiposolicitante->save();
                $msj='El tipo de solicitante de registró con éxito';
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
                $band=Tiposolicitante::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='Ingrese un tipo de solicitante';       
                }else{
                    $exi='1';
                    $Tiposolicitante =Tiposolicitante::findOrFail($id);
                    $Tiposolicitante->name=$newcat;
                    $Tiposolicitante->borrado='0';
                    $Tiposolicitante->save();
                    $msj='El tipo de solicitante de actualizó';
                }
            }else{
                $result='0';
                $msj='Ingrese un tipo de solicitante';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Tiposolicitante =Tiposolicitante::findOrFail($id);
            $Tiposolicitante->borrado='1';
            $Tiposolicitante->save();
            $msj='El tipo de solicitante se eliminó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
