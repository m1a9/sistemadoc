<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Locales;
use App\Distrito;
use DB;
use Validator;

class LocalController extends Controller{
	public function index1(){
		return view('local.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $locales=DB::table('locales')
        ->join('distritos','locales.distritos_id','=','distritos.id')
        ->where('locales.name','like','%'.$buscar.'%')
        ->select('locales.id as id','locales.name as name','locales.direccion as direccion','distritos.id as iddis','distritos.name as disname')
        ->orderBy('name')
        ->paginate(30);
        $distritos=Distrito::where('borrado',0)->orderBy('name')->get();
    	return [
            'pagination'=>[
                'total'=> $locales->total(),
                'current_page'=> $locales->currentPage(),
                'per_page'=> $locales->perPage(),
                'last_page'=> $locales->lastPage(),
                'from'=> $locales->firstItem(),
                'to'=> $locales->lastItem(),
            ],
            'locales'=>$locales,
            'distritos'=>$distritos,
        ];	
    }
    public function store(Request $request){
        $distr=$request->cbodistr;
        $nomloc=$request->txtnomloc;
        $dirloc=$request->txtdirloc;
        $result='1';
        $msj='';
        $input1  = array('nom' => $nomloc);
        $regla1 = array('nom' => 'unique:locales,name');
        $validator1 = Validator::make($input1, $regla1);
        if ($validator1->fails()) {
            $result='0';
            $msj='El local ya existe'; 
        }else{
            $result='1';
            $Locales = new Locales();
            $Locales->name=$nomloc;
            $Locales->direccion=$dirloc;
            $Locales->distritos_id=$distr;
            $Locales->save();
            $msj='El local se registró con éxito';
        }
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
    public function update(Request $request, $id){
        $distri=$request->cbodistre;
        $nomloc=$request->txtnomloce;
        $dirloc=$request->txtdirloce;
        $result='1';
        $msj='';
        $band=Locales::where('name',$nomloc)->where('id','<>',$id)->exists();
        if ($band==true) {
            $exi='0';
            $msj='El local ya existe';       
        }else{
            $exi='1';
            $Locales =Locales::findOrFail($id);
            $Locales->name=$nomloc;
            $Locales->direccion=$dirloc;
            $Locales->distritos_id=$distri;
            $Locales->save();
            $msj='El local se actualizó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
