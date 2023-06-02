<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'nif',
        'tipo_pagamento',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }

    public function Recibo()
    {
        return $this->hasMany(Recibo::class, 'cliente_id', 'id');
    }

    public function Bilhete()
    {
        return $this->hasMany(Bilhete::class, 'cliente_id', 'id');
    }
}
