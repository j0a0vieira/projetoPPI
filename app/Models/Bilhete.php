<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bilhete extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'cliente_id',
        'recibo_id',
        'sessao_id',
        'lugar_id',
        'preco_sem_iva',
        'estado',
    ];

    public function Cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id', 'id');
    }

    public function Recibo()
    {
        return $this->belongsTo(Recibo::class, 'recibo_id', 'id');
    }
}
