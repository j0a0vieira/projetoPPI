<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LugarController extends Controller
{
    public function index()
{
    $lugares = [];

    for ($i = 1; $i <= 30; $i++) {
        $lugares[] = "Lugar " . $i;
    }

    return view('lugares', ['lugares' => $lugares]);
}

    
}
