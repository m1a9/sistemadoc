<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use Validator;

class CategoriaController extends Controller{
	public function index1(){
		return view('categoria.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $categorias=Categoria::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $categorias->total(),
                'current_page'=> $categorias->currentPage(),
                'per_page'=> $categorias->perPage(),
                'last_page'=> $categorias->lastPage(),
                'from'=> $categorias->firstItem(),
                'to'=> $categorias->lastItem(),
            ],
            'categorias'=>$categorias
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
        $regla1 = array('nom' => 'unique:categorias,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Complete la descripción de la categoría';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';
                $msj='La Descripción de la Categoría Ingresada ya se encuentra Registrada'; 
            }else{
                $exi='1';
                $Categoria = new Categoria();
                $Categoria->name=$nom;
                $Categoria->borrado='0';
                $Categoria->save();
                $msj='Nueva Categoría registrada con éxito';
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
                $band=Categoria::where('name',$newcat)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='La Descripción de la Categoría Ingresada ya se encuentra Registrada';       
                }else{
                    $exi='1';
                    $Categoria =Categoria::findOrFail($id);
                    $Categoria->name=$newcat;
                    $Categoria->borrado='0';
                    $Categoria->save();
                    $msj='La Categoría a sido actualizada';
                }
            }else{
                $result='0';
                $msj='Complete la descripción de la categoría';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $Categoria =Categoria::findOrFail($id);
            $Categoria->borrado='1';
            $Categoria->save();
            $msj='La Categoría a sido eliminado';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }
}
