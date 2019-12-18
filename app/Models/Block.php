<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Block.
 *
 * @package namespace App\Models;
 */
class Block extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'parent_block_id',
        'hash',
        'height',
        'reward',
        'fees',
        'total_forged',
        'processed_amount',
    ];

}
