<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 20/02/2017
 * Time: 10:28
 */

namespace Blog\Validators;

use Prettus\Validator\LaravelValidator;

class ClienteValidator extends LaravelValidator
{
    protected $rules = [
        'nome'      => 'required|max:255',
        'email'     => 'required|email|max:255',
        'endereco'  => 'required|max:255',
        'telefone'  => 'required',
    ];
}