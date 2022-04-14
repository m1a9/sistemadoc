<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cargo;
use Validator;

class CargoController extends Controller{
	public function index1(){
		return view('cargo.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $cargos=Cargo::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $cargos->total(),
                'current_page'=> $cargos->currentPage(),
                'per_page'=> $cargos->perPage(),
                'last_page'=> $cargos->lastPage(),
                'from'=> $cargos->firstItem(),
                'to'=> $cargos->lastItem(),
            ],
            'cargos'=>$cargos
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
        $regla1 = array('nom' => 'unique:cargos,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese un cargo';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='El cargo ya existe'; 
            }else{
                $exi='1';
                $Cargo = new Cargo();
                $Cargo->name=$nom;
                $Cargo->borrado='0';
                $Cargo->save();
                $msj='El cargo se registró con éxito';
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
                $band=Cargo::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='El cargo ya existe';       
                }else{
                    $exi='1';
                    $Cargo =Cargo::findOrFail($id);
                    $Cargo->name=$newcat;
                    $Cargo->borrado='0';
                    $Cargo->save();
                    $msj='El cargo se actualizó';
                }
            }else{
                $result='0';
                $msj='Ingrese un cargo';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Cargo =Cargo::findOrFail($id);
            $Cargo->borrado='1';
            $Cargo->save();
            $msj='El cargo se eliminó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
