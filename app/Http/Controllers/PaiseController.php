<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paise;
use Validator;

class PaiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1(){
        return view('paises.index');
    }

    public function index(Request $request )
    {
         
        $buscar=$request->busca;
        $paises=Paise::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    	return [
            'pagination'=>[
                'total'=> $paises->total(),
                'current_page'=> $paises->currentPage(),
                'per_page'=> $paises->perPage(),
                'last_page'=> $paises->lastPage(),
                'from'=> $paises->firstItem(),
                'to'=> $paises->lastItem(),
            ],
            'paises'=>$paises
        ];
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 

        $nom=$request->pais;
        $result='1';
        $msj='';
        $exi='';
        $selector='';
        $input  = array('nom' => $nom);
        $reglas = array('nom' => 'required');

        $input1  = array('nom' => $nom);
        $regla1 = array('nom' => 'unique:paises,name');

        $validator = Validator::make($input, $reglas);
        $validator1 = Validator::make($input1, $regla1);
        if ($validator->fails()) {
            $result='0';
            $msj='Ingrese el Pais';
            $selector='txtcate';
        }else{
            if ($validator1->fails()) {
                $exi='0';   
                $msj='El Pais ya se encuentra registrado'; 
            }else{
                $exi='1';
                $paises = new Paise();
                $paises->name=$nom;
                $paises->borrado='0';
                $paises->save();
                $msj='Nuevo Pais registrado con éxito';
            }
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $newPais=$request->newPais;
        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';
        if ($tipo=="editar") {
            if (strlen(trim($newPais))>0) {
                $band=Paise::where('name',$newPais)->where('borrado',0)->where('id','<>',$id)->exists();
                if ($band==true) {
                    $exi='0';
                    $msj='El Pais ya se encuentra Registrada';       
                }else{
                    $exi='1';
                    $paises =Paise::findOrFail($id);
                    $paises->name=$newPais;
                    $paises->borrado='0';
                    $paises->save();
                    $msj='El Pais a sido actualizada';
                }
            }else{
                $result='0';
                $msj='Complete el Pais';
                $selector='txtcatee';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $paises =Paise::findOrFail($id);
            $paises->borrado='1';
            $paises->save();
            $msj='El pais a sido eliminado';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
