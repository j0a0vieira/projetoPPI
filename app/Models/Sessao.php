<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    protected $table = 'Sessoes';


    public function Filme()
    {
        return $this->belongsTo(Filme::class);
    }

    public function Sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function Bilhete()
    {
        return $this->hasMany(Bilhete::class);
    }
}
