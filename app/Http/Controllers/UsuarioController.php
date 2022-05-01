<?php

namespace App\Http\Controllers;
use App\Tipousuario;
use App\User;
use App\Persona;
use App\Tipodocide;
use App\Departamento;
use App\Tiposolicitante;
use Illuminate\Auth\SessionGuard;

use Validator;
use DB;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
        return view('usuarios.index');
    }

    public function index(Request $request){
        $buscar=$request->busca;
        // $usuarios=Provincia::where('name','like','%'.$buscar.'%')->where('borrado',0)->orderBy('name')->paginate(30);
        $usuarios=DB::table('users')
            ->join('tipousuarios','users.tipousuarios_id','=','tipousuarios.id')
            ->join('tiposolicitantes','users.tiposolicitantes_id','=','tiposolicitantes.id') 
            ->join('personas','users.personas_id','=','personas.id')
            ->join('tipodocide','personas.tipodocide_id','=','tipodocide.id')
            ->where('users.correo','like','%'.$buscar.'%')
            ->where('users.borrado',0)
            ->select('users.id as id','users.correo as correo','users.password as contraseña',
            'tipousuarios.name as tipousuarios','tipodocide.name as tipodoc','tiposolicitantes.name as tiposoli',
            'personas.tipodocide_id as idtipodoc','users.tiposolicitantes_id as idtiposoli','users.tipousuarios_id as idtipouser',
            'personas.documento_ide as documentoid','personas.id as idper','users.personas_id as idper2',
            'personas.apellidos as apellidos','personas.nombres as nombres','personas.direccion as direccion',
            'personas.celular as celular')
            ->orderBy('users.correo')
            ->paginate(30); 
        $tipouser = Tipousuario::orderBy('name')->where('borrado',0)->get();
        $tipodocide = Tipodocide::orderBy('name')->where('borrado',0)->get();
        $tiposoli = Tiposolicitante::orderBy('name')->where('borrado',0)->get();

        return [
            'pagination'=>[
                'total'=> $usuarios->total(),
                'current_page'=> $usuarios->currentPage(),
                'per_page'=> $usuarios->perPage(),
                'last_page'=> $usuarios->lastPage(),
                'from'=> $usuarios->firstItem(),
                'to'=> $usuarios->lastItem(),
            ],
            'tipouser'=>$tipouser,
            'tipodocumento'=>$tipodocide,
            'tiposoli'=>$tiposoli,
            'usuarios'=>$usuarios
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
        $tipoDoc=$request->tipoDoc;
        $tipoSoli=$request->tipoSoli;
        $tipoUser=$request->tipoUser;
        $docu=$request->docu;
        $apell=$request->apell;
        $nom=$request->nom;
        $direcc=$request->direcc;
        $cel=$request->cel;
        $correo=$request->correo;
        $password=$request->password;
     
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $input1  = array('tipoDoc' => $tipoDoc);
        $regla1 = array('tipoDoc' => 'required');

        $input4  = array('tipoSoli' => $tipoSoli);
        $regla4 = array('tipoSoli' => 'required');

        $input3  = array('tipoUser' => $tipoUser);
        $regla3 = array('tipoUser' => 'required');

        $input2  = array('docu' => $docu);
        $regla2 = array('docu' => 'required');

        $input5  = array('apell' => $apell);
        $regla5 = array('apell' => 'required');

        $input6  = array('nom' => $nom);
        $regla6 = array('nom' => 'required');

        $input7  = array('direcc' => $direcc);
        $regla7 = array('direcc' => 'required');

        $input8  = array('cel' => $cel);
        $regla8 = array('cel' => 'required');

        $input9  = array('correo' => $correo);
        $regla9 = array('correo' => 'required');

        $input10  = array('password' => $password);
        $regla10 = array('password' => 'required');

        $input11  = array('docu' => $docu);
        $regla11 = array('docu' => 'unique:personas,documento_ide');

        $input12  = array('correo' => $correo);
        $regla12 = array('correo' => 'unique:users,correo');

        $validator1 = Validator::make($input1, $regla1);
        $validator2 = Validator::make($input2, $regla2);
        $validator3 = Validator::make($input3, $regla3);
        $validator4 = Validator::make($input4, $regla4);
        $validator5 = Validator::make($input5, $regla5);
        $validator6 = Validator::make($input6, $regla6);
        $validator7 = Validator::make($input7, $regla7);
        $validator8 = Validator::make($input8, $regla8);
        $validator9 = Validator::make($input9, $regla9);
        $validator10 = Validator::make($input10, $regla10);
        $validator11 = Validator::make($input11, $regla11);
        $validator12 = Validator::make($input12, $regla12);




        // // // cboTipoDoc:'',
        // // //   cboTipoSoli:'',
        // // //   cboTipoUser:'',


        if($validator1->fails()){
            $result='0';
            $msj='Debe seleccionar una Tipo de documento';
            $selector='cboTipoDoc';
        }
        elseif($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el N° de documento';
            $selector='txtdocu';
        }
        elseif($validator3->fails()){
            $result='0';
            $msj='Debe Seleccionar el Tipo de usuario';
            $selector='cboTipoUser';
        }
        elseif($validator4->fails()){
            $result='0';
            $msj='Debe Seleccionar el Tipo de Solicitante';
            $selector='cboTipoUser';
        }
        elseif($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar Apellido';
            $selector='txtapell';
        }
        elseif($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Nombre';
            $selector='txtnom';
        }
        elseif($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar la Dirección';
            $selector='txtdirecc';
        }
        elseif($validator8->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular';
            $selector='txtcel';
        }
        elseif($validator9->fails())
        {
            $result='0';
            $msj='Debe ingresar el Correo';
            $selector='txtcorreo';
        }
        elseif($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar la contraseña';
            $selector='txtpassword';
        }
        elseif($validator11->fails()){
            $exi='0'; 
            $msj='El número de documento ya existe';
            // $selector='txtprov';
        }
        elseif($validator12->fails()){
            $exi='0'; 
            $msj='El Correo ya existe';
            // $selector='txtprov';
        }
        else{
        $exi='1'; 
        $persona = new Persona();
        $persona->apellidos=$apell;
        $persona->nombres=$nom;
        $persona->direccion=$direcc;
        $persona->celular=$cel;
        $persona->tipodocide_id=$tipoDoc;
        $persona->documento_ide=$docu;
        $persona->borrado='0';
        $persona->save();


        $usuario = new User();
        $usuario->correo = $correo;
        $usuario->password= bcrypt($password);
        $usuario->tipousuarios_id = $tipoUser;
        $usuario->tiposolicitantes_id=$tipoSoli;
        $usuario->borrado='0';
        $usuario->personas_id=$persona->id;
        $usuario->save();

        // auth()->login($usuario);

        $msj='Usuario registrado';
        }
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'exi'=>$exi]);
        // return $persona;
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
        $tipoDoc=$request->tipoDoc;
        $tipoSoli=$request->tipoSoli;
        $tipoUser=$request->tipoUser;
        $docu=$request->docu;
        $apell=$request->apell;
        $nom=$request->nom;
        $direcc=$request->direcc;
        $cel=$request->cel;
        $correo=$request->correo;
        $password=$request->password;

        $idper=$request->idper;
     

        $tipo=$request->tipo;
        $result='1';
        $msj='';
        $exi='';
        $selector='';

        $input1  = array('tipoDoc' => $tipoDoc);
        $regla1 = array('tipoDoc' => 'required');

        $input4  = array('tipoSoli' => $tipoSoli);
        $regla4 = array('tipoSoli' => 'required');

        $input3  = array('tipoUser' => $tipoUser);
        $regla3 = array('tipoUser' => 'required');

        $input2  = array('docu' => $docu);
        $regla2 = array('docu' => 'required');

        $input5  = array('apell' => $apell);
        $regla5 = array('apell' => 'required');

        $input6  = array('nom' => $nom);
        $regla6 = array('nom' => 'required');

        $input7  = array('direcc' => $direcc);
        $regla7 = array('direcc' => 'required');

        $input8  = array('cel' => $cel);
        $regla8 = array('cel' => 'required');

        $input9  = array('correo' => $correo);
        $regla9 = array('correo' => 'required');

        $input10  = array('password' => $password);
        $regla10 = array('password' => 'required');

        $input11  = array('docu' => $docu);
        $regla11 = array('docu' => 'unique:personas,documento_ide');

        $input12  = array('correo' => $correo);
        $regla12 = array('correo' => 'unique:users,correo');

        $validator1 = Validator::make($input1, $regla1);
        $validator2 = Validator::make($input2, $regla2);
        $validator3 = Validator::make($input3, $regla3);
        $validator4 = Validator::make($input4, $regla4);
        $validator5 = Validator::make($input5, $regla5);
        $validator6 = Validator::make($input6, $regla6);
        $validator7 = Validator::make($input7, $regla7);
        $validator8 = Validator::make($input8, $regla8);
        $validator9 = Validator::make($input9, $regla9);
        $validator10 = Validator::make($input10, $regla10);
        $validator11 = Validator::make($input11, $regla11);
        $validator12 = Validator::make($input12, $regla12);


        if ($tipo=="editar") {

        if($validator1->fails()){
            $result='0';
            $msj='Debe seleccionar una Tipo de documento';
            $selector='cboTipoDoc';
        }
        elseif($validator2->fails())
        {
            $result='0';
            $msj='Debe ingresar el N° de documento';
            $selector='txtdocu';
        }
        elseif($validator3->fails()){
            $result='0';
            $msj='Debe Seleccionar el Tipo de usuario';
            $selector='cboTipoUser';
        }
        elseif($validator4->fails()){
            $result='0';
            $msj='Debe Seleccionar el Tipo de Solicitante';
            $selector='cboTipoUser';
        }
        elseif($validator5->fails())
        {
            $result='0';
            $msj='Debe ingresar Apellido';
            $selector='txtapell';
        }
        elseif($validator6->fails())
        {
            $result='0';
            $msj='Debe ingresar el Nombre';
            $selector='txtnom';
        }
        elseif($validator7->fails())
        {
            $result='0';
            $msj='Debe ingresar la Dirección';
            $selector='txtdirecc';
        }
        elseif($validator8->fails())
        {
            $result='0';
            $msj='Debe ingresar el Celular';
            $selector='txtcel';
        }
        elseif($validator9->fails())
        {
            $result='0';
            $msj='Debe ingresar el Correo';
            $selector='txtcorreo';
        }
        elseif($validator10->fails())
        {
            $result='0';
            $msj='Debe ingresar la contraseña';
            $selector='txtpassword';
        }
        elseif($validator11->fails()){
            $exi='0'; 
            $msj='El número de documento ya existe';
            // $selector='txtprov';
        }
        elseif($validator12->fails()){
            $exi='0'; 
            $msj='El Correo ya existe';
            // $selector='txtprov';
        }
            else{

             

                $persona = Persona::findOrFail($idper);
                $persona->apellidos=$apell;
                $persona->nombres=$nom;
                $persona->direccion=$direcc;
                $persona->celular=$cel;
                $persona->tipodocide_id=$tipoDoc;
                $persona->documento_ide=$docu;
                $persona->borrado='0';
                $persona->save();

                $exi='1';
                $usuario = User::findOrFail($id);
                $usuario->correo = $correo;
                $usuario->password= bcrypt($password);
                $usuario->tipousuarios_id = $tipoUser;
                $usuario->tiposolicitantes_id=$tipoSoli;
                $usuario->borrado='0';
                $usuario->personas_id=$persona->id;
                $usuario->save();
    
            
                $msj='El Usuario a sido actualizada';
            }
        }
        if ($tipo=="eliminar") {
            $exi='1';

            $persona = Persona::findOrFail($idper);
            $persona->borrado='1';
            $persona->save();
            
            $usuario =User::findOrFail($id);
            $usuario->borrado='1';
            $usuario->save();


           
            
            $msj='El Usuario a sido eliminado';
           
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
