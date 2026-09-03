<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = [
        '_token',
        'nome',
        'descricao',
        'data',
        'hora_inicio',
        'hora_fim',
        'recorrente',
        'recorrencia'
    ];
}
