<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Distrito;
use App\Departamento;
use App\Provincia;
use App\Paise;
use Validator;
use DB;

class DistritoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1(){
        return view('distrito.index');
    } 
    public function index(Request $request)
    {
    $buscar=$request->busca;
    $distritos=Distrito::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
    $distritosProvi=DB::table('distritos')
        ->join('provincias','distritos.provincias_id','=','provincias.id')
        ->join('departamentos','provincias.departamentos_id','=','departamentos.id')
        ->join('paises','departamentos.paises_id','=','paises.id') 
        ->where('distritos.borrado',0)
        ->where('distritos.name','like','%'.$buscar.'%')
        ->select('distritos.id as id','distritos.name as name','paises.id as idpais','departamentos.id as iddepar','provincias.id as idprovi',
        'provincias.name as proviname','departamentos.name as depaname','paises.name as paisname')
        ->orderBy('name')
        ->paginate(30); 
    $pais = Paise::orderBy('name')->where('borrado',0)->get();
    $departamentos = Departamento::orderBy('name')->where('borrado',0)->get();
    $provincias = Provincia::orderBy('name')->where('borrado',0)->get();

    return [
        'pagination'=>[
            'total'=> $distritosProvi->total(),
            'current_page'=> $distritosProvi->currentPage(),
            'per_page'=> $distritosProvi->perPage(),
            'last_page'=> $distritosProvi->lastPage(),
            'from'=> $distritosProvi->firstItem(),
            'to'=> $distritosProvi->lastItem(),
        ],
        'pais'=>$pais,
        'depa'=>$departamentos,
        'provi'=>$provincias,
        'distritos'=>$distritosProvi
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
   
        $newProvi=$request->newProvi;
        $newDistri=$request->newDistri;

        $input1  = array('newDistri' => $newDistri);
        $reglas1 = array('newDistri' => 'required');

        
        $input2  = array('newDistri' => $newDistri);
        $reglas2 = array('newDistri' => 'unique:distritos,name');

        $input3  = array('newProvi' => $newProvi);
        $reglas3 = array('newProvi' => 'required');

        
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);


        if($validator3->fails()){
            $result='0';
            $msj='Debe seleccionar una Provincia';
            $selector='cboProvincias';
        }
        elseif($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar un Distrito';
            $selector='txtdistr';
        }elseif($validator2->fails()){
            $result='0';
            $exi='0'; 
            $msj='El distrito ya se encuentra registrado';
            $selector='txtdistr';
        }
        else{
            $exi='1'; 
            $provi = new Distrito();
            $provi->name=$newDistri;
            $provi->borrado='0';
            $provi->provincias_id=$newProvi;
            $provi->save();
            
            $msj='Distrito registrado';
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

        $newProvi=$request->newProvi;
        $newDistri=$request->newDistri;

        $input1  = array('newDistri' => $newDistri);
        $reglas1 = array('newDistri' => 'required');

        
        $input2  = array('newDistri' => $newDistri);
        $reglas2 = array('newDistri' => 'unique:distritos,name');

        $input3  = array('newProvi' => $newProvi);
        $reglas3 = array('newProvi' => 'required');

        
        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);

        if ($tipo=="editar") {
           if($validator3->fails()){
            $result='0';
            $msj='Debe seleccionar una Provincia';
            $selector='cboProvincias';
        }
        elseif($validator1->fails())
        {
            $result='0';
            $msj='Debe ingresar un Distrito';
            $selector='txtdistr';
        }elseif($validator2->fails()){
            $result='0';
            $exi='0'; 
            $msj='El distrito ya se encuentra registrado';
            $selector='txtdistr';
        }
        else{
            $exi='1'; 
            $provi = Distrito::findOrFail($id);
            $provi->name=$newDistri;
            $provi->borrado='0';
            $provi->provincias_id=$newProvi;
            $provi->save();
            
            $msj='Distrito Actualizado';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';
            $depa =Distrito::findOrFail($id);
            $depa->borrado='1';
            $depa->save();
            $msj='El distrito a sido eliminado';
            
           
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
