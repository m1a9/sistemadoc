<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipousuario;
use Validator;

class TipousuarioController extends Controller{
	public function index1(){
		return view('tipousuario.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $tipousuarios=Tipousuario::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $tipousuarios->total(),
                'current_page'=> $tipousuarios->currentPage(),
                'per_page'=> $tipousuarios->perPage(),
                'last_page'=> $tipousuarios->lastPage(),
                'from'=> $tipousuarios->firstItem(),
                'to'=> $tipousuarios->lastItem(),
            ],
            'tipousuarios'=>$tipousuarios
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
        $regla1 = array('nom' => 'unique:tipousuarios,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese un tipo de usuario';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='El tipo de usuario ya existe'; 
            }else{
                $exi='1';
                $Tipousuario = new Tipousuario();
                $Tipousuario->name=$nom;
                $Tipousuario->borrado='0';
                $Tipousuario->save();
                $msj='El tipo de usuario se registró con éxito';
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
                $band=Tipousuario::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='El tipo de usuario ya existe';       
                }else{
                    $exi='1';
                    $Tipousuario =Tipousuario::findOrFail($id);
                    $Tipousuario->name=$newcat;
                    $Tipousuario->borrado='0';
                    $Tipousuario->save();
                    $msj='El tipo de usuario se actualizó';
                }
            }else{
                $result='0';
                $msj='Ingrese un tipo de usuario';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Tipousuario =Tipousuario::findOrFail($id);
            $Tipousuario->borrado='1';
            $Tipousuario->save();
            $msj='El tipo de usuario de ha eliminado';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
