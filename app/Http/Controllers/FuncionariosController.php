<?php

namespace App\Http\Controllers;

use App\Models\User;

class FuncionariosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $funcionarios = User::where('tipo', 'F')->get();

        return view('funcionarios')->with('funcionarios', $funcionarios);
    }
}
