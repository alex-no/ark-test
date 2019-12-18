<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Wallet;

/**
 * Class WalletTransformer.
 *
 * @package namespace App\Models\Transformers;
 */
class WalletTransformer extends TransformerAbstract
{
    /**
     * Transform the Wallet entity.
     *
     * @param \App\Models\Wallet $model
     *
     * @return array
     */
    public function transform(Wallet $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
