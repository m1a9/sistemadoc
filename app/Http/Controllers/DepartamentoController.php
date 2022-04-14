<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Paise;
use App\Departamento;
use Validator;
use DB; 

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function byidpaises($id){

        return Departamento::where('paises_id',$id)->get();

    }

    public function index1(){
        return view('departamento.index');
    }

    public function index(Request $request)
    {

        $buscar=$request->busca;
        $departamentos=Departamento::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
        $departamentoPais=DB::table('departamentos')
            ->join('paises','departamentos.paises_id','=','paises.id') 
            ->where('departamentos.name','like','%'.$buscar.'%')
            ->where('departamentos.borrado',0)
            ->select('departamentos.id as id','paises.id as idpa','departamentos.name as name','paises.name as paisedepa')
            ->orderBy('name')
            ->paginate(30); 
        $pais = Paise::orderBy('name')->where('borrado',0)->get();
    	return [
            'pagination'=>[
                'total'=> $departamentoPais->total(),
                'current_page'=> $departamentoPais->currentPage(),
                'per_page'=> $departamentoPais->perPage(),
                'last_page'=> $departamentoPais->lastPage(),
                'from'=> $departamentoPais->firstItem(),
                'to'=> $departamentoPais->lastItem(),
            ],
            'pais'=>$pais,
            'departamentos'=>$departamentoPais
        ];	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
        $newPais=$request->newPais;
        $newDepa=$request->newDepa;

        $input1  = array('newPais' => $newPais);
        $reglas1 = array('newPais' => 'required');

        
        $input2  = array('newDepa' => $newDepa);
        $reglas2 = array('newDepa' => 'unique:Departamentos,name');

        $input3  = array('newDepa' => $newDepa);
        $reglas3 = array('newDepa' => 'required');

        
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);


        if($validator1->fails()){
            $result='0';
            $msj='Debe seleccionar una Pais';
            $selector='cboPaises';
        }
        elseif($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar un Departamento';
            $selector='txtdepa';
        }elseif($validator2->fails()){
            $result='0';
            $exi='0'; 
            $msj='El Departamento ya se encuentra registrado';
            $selector='txtdepa';
        }
        else{
        $exi='1'; 
        $depa = new Departamento();
        $depa->name=$newDepa;
        $depa->borrado='0';
        $depa->paises_id=$newPais;
        $depa->save();
        
        $msj='Departamento registrado';
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
    public function edit(Request $request,$id)
    {
       
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
        $newDepa=$request->newDepa;

        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $input1  = array('newPais' => $newPais);
        $reglas1 = array('newPais' => 'required');

        
        $input2  = array('newDepa' => $newDepa);
        $reglas2 = array('newDepa' => 'unique:Departamentos,name');

        $input3  = array('newDepa' => $newDepa);
        $reglas3 = array('newDepa' => 'required');

        
        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);

        if ($tipo=="editar") {
            if($validator1->fails()){
                $result='0';
                $msj='Debe seleccionar una Pais';
                $selector='cboPaises';
            }
            elseif($validator3->fails())
            {
                $result='0';
                $msj='Debe ingresar un Departamento';
                 $selector='txtdepa';

            }elseif($validator2->fails()){
                $result='0';
                $exi='0'; 
                $msj='El Departamento ya se encuentra registrado';
                $selector='txtdepa';
            }
            else{
    
                $exi='1';
                $depa =Departamento::findOrFail($id);
                $depa->name=$newDepa;
                $depa->borrado='0';
                $depa->paises_id=$newPais;
                $depa->save();
                $msj='El Departamento a sido actualizada';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $depa =Departamento::findOrFail($id);
            $depa->borrado='1';
            $depa->save();
            $msj='El Departamento a sido eliminado';
           
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
