<?php

namespace Blog\Validators;

use \Prettus\Validator\LaravelValidator;

class ProjectValidator extends LaravelValidator
{

    protected $rules = [
        'owner_id' => 'required|integer',
        'cliente_id' => 'required|integer',
        'nome' => 'required|max:255',
        'descricao' => 'required',
        'progresso' => 'required',
        'status' => 'required',
        'data_final' => 'required|date'
   ];
}
