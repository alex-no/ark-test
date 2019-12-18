<?php

namespace App\Models\Presenters;

use App\Models\Transformers\BlockTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class BlockPresenter.
 *
 * @package namespace App\Models\Presenters;
 */
class BlockPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new BlockTransformer();
    }
}
