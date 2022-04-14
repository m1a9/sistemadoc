<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departamento;
use App\Provincia;
use App\Paise;
use Validator;
use DB;

class ProvinciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function byiddepa($id){

        return Provincia::where('departamentos_id',$id)->get();

    }
    public function index1(){
        return view('provincia.index');
    }

    public function index(Request $request)
    {
    $buscar=$request->busca;
    $provincias=Provincia::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    $provinciaDepa=DB::table('provincias')
        ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
        ->join('paises','departamentos.paises_id','=','paises.id') 
        ->where('provincias.borrado',0)
        ->where('provincias.name','like','%'.$buscar.'%')
        ->select('provincias.id as id','provincias.name as name','departamentos.name as depaname','paises.name as paisname','paises.id as idpai','departamentos.id as iddepar')
        ->orderBy('name')
        ->paginate(30); 
    $pais = Paise::orderBy('name')->where('borrado',0)->get();
    $departamentos = Departamento::orderBy('name')->where('borrado',0)->get();
    return [
        'pagination'=>[
            'total'=> $provinciaDepa->total(),
            'current_page'=> $provinciaDepa->currentPage(),
            'per_page'=> $provinciaDepa->perPage(),
            'last_page'=> $provinciaDepa->lastPage(),
            'from'=> $provinciaDepa->firstItem(),
            'to'=> $provinciaDepa->lastItem(),
        ],
        'pais'=>$pais,
        'depa'=>$departamentos,
        'provincias'=>$provinciaDepa
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

        $newDepa=$request->newDepa;
        $newProvi=$request->newProvi;

        $input1  = array('newProvi' => $newDepa);
        $reglas1 = array('newProvi' => 'required');

        $input2  = array('newProvi' => $newProvi);
        $reglas2 = array('newProvi' => 'unique:provincias,name');

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
            $msj='Debe seleccionar una Departamento';
            $selector='cboDepartamentos';
        }
        elseif($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar una Provincia';
            $selector='txtprov';
        }elseif($validator2->fails()){
            $result='0';
            $exi='0'; 
            $msj='La provincia ya se encuentra registrado';
            $selector='txtprov';
        }
        else{
        $exi='1'; 
        $provi = new Provincia();
        $provi->name=$newProvi;
        $provi->borrado='0';
        $provi->departamentos_id=$newDepa;
        $provi->save();
        
        $msj='Provincia registrado';
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
        $newDepa=$request->newDepa;
        $newProvi=$request->newProvi;

        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $input1  = array('newProvi' => $newProvi);
        $reglas1 = array('newProvi' => 'required');

        
        $input2  = array('newProvi' => $newProvi);
        $reglas2 = array('newProvi' => 'unique:Provincias,name');

        $input3  = array('newDepa' => $newDepa);
        $reglas3 = array('newDepa' => 'required');

        
        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);

        if ($tipo=="editar") {
            if($validator3->fails()){
                $result='0';
                $msj='Debe seleccionar una Departamento';
                $selector='cboDepartamentos';
            }
            elseif($validator1->fails())
            {
                $result='0';
                $msj='Debe ingresar una Provincia';
                 $selector='txtprov';

            }elseif($validator2->fails()){
                $result='0';
                $exi='0'; 
                $msj='La provincia ya se encuentra registrado';
                $selector='txtprov';
            }
            else{
    
                $exi='1';
                $depa =Provincia::findOrFail($id);
                $depa->name=$newProvi;
                $depa->borrado='0';
                $depa->departamentos_id=$newDepa;
                $depa->save();
                $msj='La provincia a sido actualizada';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $depa =Provincia::findOrFail($id);
            $depa->borrado='1';
            $depa->save();
            $msj='La provincia a sido eliminado';
           
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
