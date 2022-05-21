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

class PerfilController extends Controller
{
    public function index1(){
        return view("perfil.index");
    }

    public function index(Request $request){
        // $iduser=$request->iduser;
        if(auth()->check()){
         $iduser=auth()->user()->id;
        }
        
       
        $usuarios=DB::table('users')
        ->join('tipousuarios','users.tipousuarios_id','=','tipousuarios.id')
        ->join('tiposolicitantes','users.tiposolicitantes_id','=','tiposolicitantes.id') 
        ->join('personas','users.personas_id','=','personas.id')
        ->join('tipodocide','personas.tipodocide_id','=','tipodocide.id')
        ->where('users.id',$iduser)
        ->where('users.borrado',0)
        ->select('users.id as id','users.correo as correo','users.password as contraseña',
        'tipousuarios.name as tipousuarios','tipodocide.name as tipodoc','tiposolicitantes.name as tiposoli',
        'personas.tipodocide_id as idtipodoc','users.tiposolicitantes_id as idtiposoli','users.tipousuarios_id as idtipouser',
        'personas.documento_ide as documentoid','personas.id as idper','users.personas_id as idper2',
        'personas.apellidos as apellidos','personas.nombres as nombres','personas.direccion as direccion',
        'personas.celular as celular')
        ->get();

        return view('perfil.index',compact('usuarios'));

    }

    public function store(Request $request){
        if(auth()->check()){
            $iduser=auth()->user()->id;
           }
           $user =User::findOrFail($iduser);
           $result='1';
           $msj='';
           $exi='';
           $selector='';
           $pass1 = $request -> pass1;
           $pass2 = $request -> pass2;
           if($pass1 == $user->password2){
               if (strlen(trim($pass2))>0) {
                       $exi='1';
                    //    $user =User::findOrFail($iduser);
                       $user->password=bcrypt($pass2);
                       $user->password2=$pass2;
                       $user->borrado='0';
                       $user->save();
                       $msj='Contraseña Actualizada';
               }else{
                   $result='0';
                   $msj='Complete la Contraseña';
                   $selector='pass1';
               }
            }else{
                $msj = 'Contraseña actual no coincide ';
            }

               return redirect()->route('perfils.index',$msj);

    }
}
