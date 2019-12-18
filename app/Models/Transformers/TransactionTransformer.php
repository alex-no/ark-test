<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Transaction;

/**
 * Class TransactionTransformer.
 *
 * @package namespace App\Models\Transformers;
 */
class TransactionTransformer extends TransformerAbstract
{
    /**
     * Transform the Transaction entity.
     *
     * @param \App\Models\Transaction $model
     *
     * @return array
     */
    public function transform(Transaction $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
