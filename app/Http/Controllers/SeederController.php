<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SeederController extends Controller
{
    public function index(Request $request){
        \Artisan::call('migrate:fresh --seed');
        return redirect()->route('index')->with('success', 'The data base is redy to test');
    }
}
