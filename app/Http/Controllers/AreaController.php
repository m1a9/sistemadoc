<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\Locales;
use DB;
use Validator;

class AreaController extends Controller{
	public function index1(){
		return view('area.index');
	}
	public function index(Request $request){
        $buscar=$request->busca;
        $locales=DB::table('areas as area1')
        ->join('locales','area1.locales_id','=','locales.id')
        ->leftjoin('areas as area2','area1.areas_id','=','area2.id')
        ->where('locales.name','like','%'.$buscar.'%')
        ->select('locales.name as nomloc','locales.direccion as direccion','area1.name as nomare1','area2.name as nomare2','area1.sigla as sigare1','area1.telefono as telare1','area1.anexo as aneare1','area1.correo as corare1','area1.locales_id as idlocare1','area1.areas_id as idareare1','area1.id as ida1')
        ->orderBy('nomloc')
        ->paginate(30);
        $local=Locales::orderBy('name')->get();
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
            'local'=>$local,
        ];	
    }
    public function getarea($id){
        $area=Area::where('locales_id',$id)->orderBy('name')->get();
        return response()->json(["area"=>$area]);
    }
    public function store(Request $request){
        $cboloc=$request->cboloc;
        $txtnoma=$request->txtnoma;
        $txtcorr=$request->txtcorr;
        $txtsigla=$request->txtsigla;
        $txttel=$request->txttel;
        $txtanexo=$request->txtanexo;
        $cbosuba=$request->cbosuba;
        $result='1';
        $msj='';
        $input1  = array('nom' => $txtnoma);
        $regla1 = array('nom' => 'unique:areas,name');
        $validator1 = Validator::make($input1, $regla1);
        if ($validator1->fails()) {
            $result='0';
            $msj='El área ya existe'; 
        }else{
            $result='1';
            $Area = new Area();
            $Area->name=$txtnoma;
            $Area->sigla=$txtsigla;
            $Area->telefono=$txttel;
            $Area->anexo=$txtanexo;
            $Area->correo=$txtcorr;
            $Area->locales_id=$cboloc;
            $Area->areas_id=$cbosuba;
            $Area->save();
            $msj='El área se registró con éxito';
        }
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
    public function update(Request $request, $id){
        $cboloc=$request->cboloce;
        $txtnoma=$request->txtnomae;
        $txtcorr=$request->txtcorre;
        $txtsigla=$request->txtsiglae;
        $txttel=$request->txttele;
        $txtanexo=$request->txtanexoe;
        $cbosuba=$request->cbosubae;

        $result='1';
        $msj='';
        $band=Area::where('name',$txtnoma)->where('id','<>',$id)->exists();
        if ($band==true) {
            $exi='0';
            $msj='El área ya existe';       
        }else{
            $exi='1';
            $Area = Area::findOrFail($id);
            $Area->name=$txtnoma;
            $Area->sigla=$txtsigla;
            $Area->telefono=$txttel;
            $Area->anexo=$txtanexo;
            $Area->correo=$txtcorr;
            $Area->locales_id=$cboloc;
            $Area->areas_id=$cbosuba;
            $Area->save();
            $msj='El local se actualizó';
        }
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
}
