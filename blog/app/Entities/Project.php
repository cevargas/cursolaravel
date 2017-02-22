<?php

namespace Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'owner_id',
        'cliente_id',
        'nome',
        'descricao',
        'progresso',
        'status',
        'data_final'
    ];

    public function notes(){
        return $this->hasMany(ProjectNote::class);
    }

    public function members(){
        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'member_id');
    }
}