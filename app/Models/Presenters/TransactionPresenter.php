<?php

namespace App\Models\Presenters;

use App\Models\Transformers\TransactionTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class TransactionPresenter.
 *
 * @package namespace App\Models\Presenters;
 */
class TransactionPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new TransactionTransformer();
    }
}
