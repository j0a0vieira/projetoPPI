<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sala extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome'
    ];

    public function Lugares()
    {
        return $this->hasMany(Lugar::class);
    }

    public function Sessao()
    {
        return $this->hasMany(Sessao::class);
    }
}
