<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddNewRegion extends Controller
{
    public function adnewregion(){
        return view('rota.addnewregion');
    }
}
