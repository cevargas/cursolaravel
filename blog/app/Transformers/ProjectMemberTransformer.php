<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 22/02/2017
 * Time: 10:24
 */

namespace Blog\Transformers;

use Blog\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{
    public function transform(User $member)
    {
        return [
            'id' => $member->id,
            'name' => $member->name,
            'email' => $member->email
        ];
    }
}