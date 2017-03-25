<?php

namespace Blog\Transformers;

use Blog\Entities\ProjectNote;
use League\Fractal\TransformerAbstract;

class ProjectNoteTransformer extends TransformerAbstract
{

    public function transform(ProjectNote $model)
    {
        return [
            'id'        => (int) $model->id,
            'titulo'    => $model->titulo,
            'anotacao'  => $model->anotacao
        ];
    }
}