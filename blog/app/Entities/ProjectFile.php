<?php

namespace Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProjectFile extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'nome',
        'descricao',
        'extensao'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
