<?php

namespace Blog\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'name' => 'required|max:255',
        'start_date' => 'required',
        'due_date' => 'required',
        'status' => 'required|integer'
    ];
}
