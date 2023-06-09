<?php

namespace App\Http\Controllers;

use App\Models\Bilhete;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('cliente')->find(Auth::id());

        return view('profile', compact('user'));
    }

    public function listAll()
    {
        $users = User::where('tipo', 'C')->get();

        return view('users')->with('users', $users);
    }

    public function listAllFuncionarios()
    {
        $funcionarios = User::where('tipo', 'F')->get();

        return view('funcionarios')->with('funcionarios', $funcionarios);
    }

    public function listAllAdmins()
    {
        $authenticatedUserId = auth()->user()->id;

        $users = User::where('tipo', 'A')
            ->where('id', '!=', $authenticatedUserId)
            ->get();

        return view('admins')->with('admins', $users);
    }

    public function userProfile($id)
    {
        $user = User::find($id);

        return view('profile')->with('user', $user);
    }

    public function deleteProfile($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back();
    }


    public function bloquearProfile($id)
    {
        $user = User::find($id);

        if ($user->bloqueado) {
            $user->update([
                'bloqueado' => 0,
            ]);
        } else if (!$user->bloqueado) {
            $user->update([
                'bloqueado' => 1,
            ]);
        }

        return redirect()->back();
    }

    public function update(User $user, Request $request)
    {
        $caminho = $user->foto_url;

        if ($request->hasFile('foto')) {

            $imagem = $request->file('foto');
            $caminho = $user->id . "_" . uniqid() . '.' . $imagem->extension();
            $imagem->storeAs('public/fotos', $caminho);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
            'foto_url' => $caminho,
        ]);

        if ($user->cliente) {
            $user->cliente->update([
                'nif' => $request->nif,
                'tipo_pagamento' => $request->tipo_pagamento,
            ]);
        } else {
            $user->cliente()->create([
                'id' => $user->id,
                'nif' => $request->nif,
                'tipo_pagamento' => $request->tipo_pagamento,
            ]);
        }

        return redirect()->back();
    }

    public function store(Request $request)
    {
        $userData = $request->only(['name', 'email', 'password', 'tipo']);
        $userData['password'] = Hash::make($userData['password']);
        User::create($userData);

        return redirect()->route('home');
    }

    public function searchAdmins(Request $request)
    {
        $searchQuery = $request->query('search');
        if ($searchQuery) {
            $admins = User::where('name', 'LIKE', "%$searchQuery%")
                ->where('tipo', 'A')
                ->get();
        } else {
            return redirect()->route("administradores");
        }

        return view('admins', ['admins' => $admins]);
    }

    public function searchUsers(Request $request)
    {
        $searchQuery = $request->query('search');
        if ($searchQuery) {
            $clientes = User::where('name', 'LIKE', "%$searchQuery%")->where('tipo', 'C')->get();
        } else {
            return redirect()->route("users");
        }


        return view('users', ['users' => $clientes]);
    }

    public function searchFuncionarios(Request $request)
    {
        $searchQuery = $request->query('search');
        if ($searchQuery) {
            $funcionarios = User::where('name', 'LIKE', "%$searchQuery%")->where('tipo', 'F')->get();
        } else {
            return redirect()->route("funcionarios");
        }

        return view('funcionarios', ['funcionarios' => $funcionarios]);
    }

    public function bilhetes()
    {
        $bilhetes = Bilhete::where('cliente_id', Auth::user()->cliente->id)->get();

        if ($bilhetes->count() === 0) {
            return view('bilhetes')->with('bilhetes', null);
        }

        return view('bilhetes')->with('bilhetes', $bilhetes);
    }
}
