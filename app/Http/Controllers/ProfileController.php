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

        $imagem = $request->hasFile('foto');
        $newImagem = $request->file('foto');
        $caminho = $newImagem->store('fotos');

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'updated_at' => now(),
            'foto_url' => $caminho,
        ]);

        return $this->index();
    }
}
