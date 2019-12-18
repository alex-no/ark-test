<?php

namespace App\Models\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Block;

/**
 * Class BlockTransformer.
 *
 * @package namespace App\Models\Transformers;
 */
class BlockTransformer extends TransformerAbstract
{
    /**
     * Transform the Block entity.
     *
     * @param \App\Models\Block $model
     *
     * @return array
     */
    public function transform(Block $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
