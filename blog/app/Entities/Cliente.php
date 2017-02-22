<?php

namespace Blog\Entities;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'endereco',
        'telefone',
        'observacoes'
    ];
}
