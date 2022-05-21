<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Tipousuario;


class SessionController extends Controller
{
    public function create(){
        auth()->logout();
        $tipoUser=Tipousuario::where('borrado',0)->orderBy('name')->get();
        return view('auth.login',compact('tipoUser'));

    }
    public function store(){
           // return request();
    // $credenciales = request()->only('correo','password');

    if(auth()->attempt(request(['correo','password','tipousuarios_id']))==false){
    return back()->withErrors([
        'message' => 'Error en el ingreso de credenciales'
    ]) ;
    }
    return  redirect()->to('/home');
}
    public function destroy(){
        auth()->logout();

        return redirect()->to('/login');

    }

}
