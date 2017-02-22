<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 22/02/2017
 * Time: 10:24
 */

namespace Blog\Transformers;

use Blog\Entities\Project;
use League\Fractal\TransformerAbstract;

class ProjectTransformer extends TransformerAbstract
{

    protected $defaultIncludes = ['members'];

    public function transform(Project $project)
    {
        return [
            'id' => $project->id,
            'cliente_id' => $project->cliente_id,
            'owner_id' => $project->owner_id,
            'nome' => $project->nome,
            'descricao' => $project->descricao,
            'progresso' => $project->progresso,
            'status' => $project->status,
            'data_final' => $project->data_final
        ];
    }

    public function includeMembers(Project $project)
    {
        return $this->collection($project->members, new ProjectMemberTransformer());
    }
}