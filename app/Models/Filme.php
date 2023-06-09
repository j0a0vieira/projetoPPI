<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Filme extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'sumario',
        'genero_code',
        'ano',
        'updated_at',
        'cartaz_url',
        'trailer_url',
        'created_at'
    ];

    public function Sessoes()
    {
        return $this->hasMany(Sessao::class);
    }
}
