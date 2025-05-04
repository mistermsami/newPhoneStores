<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function returncreate(){
        return view('return.create');
    }
    public function returnindex(){
        return view('return.index');
    }
}
