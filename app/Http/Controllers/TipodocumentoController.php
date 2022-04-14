<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipodocumento;
use Validator;

class TipodocumentoController extends Controller{
	public function index1(){
		return view('tipodocumento.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $tipodocumentos=Tipodocumento::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $tipodocumentos->total(),
                'current_page'=> $tipodocumentos->currentPage(),
                'per_page'=> $tipodocumentos->perPage(),
                'last_page'=> $tipodocumentos->lastPage(),
                'from'=> $tipodocumentos->firstItem(),
                'to'=> $tipodocumentos->lastItem(),
            ],
            'tipodocumentos'=>$tipodocumentos
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
        $regla1 = array('nom' => 'unique:tipodocumentos,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese un tipo de documento';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='El tipo de documento ya existe'; 
            }else{
                $exi='1';
                $Tipodocumento = new Tipodocumento();
                $Tipodocumento->name=$nom;
                $Tipodocumento->borrado='0';
                $Tipodocumento->save();
                $msj='El tipo de documento se registró con éxito';
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
                $band=Tipodocumento::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='El tipo de documento ya existe';       
                }else{
                    $exi='1';
                    $Tipodocumento =Tipodocumento::findOrFail($id);
                    $Tipodocumento->name=$newcat;
                    $Tipodocumento->borrado='0';
                    $Tipodocumento->save();
                    $msj='El tipo de documento se actualizó';
                }
            }else{
                $result='0';
                $msj='Ingrese un tipo de documento';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Tipodocumento =Tipodocumento::findOrFail($id);
            $Tipodocumento->borrado='1';
            $Tipodocumento->save();
            $msj='El tipo de documento se eliminó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
