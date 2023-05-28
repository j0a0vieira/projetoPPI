<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with('cliente')->find(Auth::id());

        return view('profile', compact('user'));
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
            ]);
        } else {
            $user->cliente()->create([
                'id' => $user->id,
                'nif' => $request->nif,
            ]);
        }

        return redirect()->route('profile');
    }
}
