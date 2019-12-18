<?php

namespace App\Models\Presenters;

use App\Models\Transformers\WalletTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class WalletPresenter.
 *
 * @package namespace App\Models\Presenters;
 */
class WalletPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new WalletTransformer();
    }
}
