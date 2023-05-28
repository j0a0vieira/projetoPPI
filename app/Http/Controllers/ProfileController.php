<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function listAllAdmins()
    {
        $users = User::where('tipo', 'A')->get();

        return view('users')->with('users', $users);
    }

    public function userProfile($id)
    {
        $user = User::find($id);

        return view('profile')->with('user', $user);
    }

    public function deleteProfile($id)
    {
        $user = User::find($id);

        if ($user->cliente) {
            $cliente = $user->cliente;

            // Delete associated bilhetes records
            foreach (optional($cliente->bilhetes) ?? [] as $bilhete) {
                $bilhete->delete();
            }

            // Delete cliente record
            $cliente->delete();
        }

        $user->delete();

        return redirect()->route('home');;
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

        return redirect()->route('home');
    }

    public function update(User $user, Request $request)
    {
        $caminho = $user->foto_url;

        if ($request->hasFile('foto')) {
            $newImagem = $request->file('foto');
            $caminho = $newImagem->store('fotos');
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

        return redirect()->route('home');
    }
}
