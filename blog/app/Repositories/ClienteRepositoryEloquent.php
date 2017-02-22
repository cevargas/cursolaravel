<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 12/02/2017
 * Time: 15:18
 */

namespace Blog\Repositories;

use Blog\Entities\Cliente;
use Prettus\Repository\Eloquent\BaseRepository;

class ClienteRepositoryEloquent extends BaseRepository implements ClienteRepository
{
    public function model()
    {
        return Cliente::class;
    }
}