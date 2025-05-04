<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rota;
use App\Models\Addresses;
class RotaController extends Controller
{
    public function index(){
        if(auth()->user()->role == 'user'){
            $rota = Rota::where('user_id', auth()->user()->id)->first();
        }
        else{
            $rota = Rota::all()->count();
        }
        return view('rota.index',['rota'=>$rota]);
    }
    public function rotaCreate(){
        return view('rota.create');
    }
    public function rotaEdit($rota_id){
        $rota = Rota::find($rota_id);
        return view('rota.edit',['rota'=>$rota]);
    }
    public function rotaShow($rota_id){
        $rota = Rota::with('User', 'Cities','Regions', 'Addresses')->find($rota_id);
        return view('rota.show',['rota'=>$rota]);
    }
    public function addnewregion(){
        return view('rota.addnewregion');
    }
    public function viewRegions(){
        $viewRecords = Addresses::with('Regions', 'Regions.Cities')->get();
        return view('rota.viewregions', ['viewRecords'=> $viewRecords]);
    }
    public function editaddress($address_id){
        $thisaddress = Addresses::find($address_id);
        return view('rota.editaddress', ['thisaddress'=> $thisaddress]);
    }
}
