<?php

namespace Blog\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'titulo' => 'required|max:255',
        'anotacao' => 'required',
   ];
}
