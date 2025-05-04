<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $customers = Customer::get(['id', 'name']); 
        return view('location.location', [
            'customers' => $customers,
        ]);
    }
}
