<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create(){
        auth()->logout();
        return view('auth.login');

    }
    public function store(){
           // return request();
    // $credenciales = request()->only('correo','password');

    if(auth()->attempt(request(['correo','password']))==false){
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
