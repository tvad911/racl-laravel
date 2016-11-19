<?php

namespace App\Presenters;

use App\Transformers\GroupTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class GroupPresenter
 *
 * @package namespace App\Presenters\Backend;
 */
class GroupPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new GroupTransformer();
    }
}
