<?php
/**
 * Created by PhpStorm.
 * User: Carlos Eduardo
 * Date: 22/02/2017
 * Time: 10:39
 */

namespace Blog\Presenters;

use Blog\Transformers\ProjectTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

class ProjectPresenter extends FractalPresenter
{

    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProjectTransformer();
    }
}