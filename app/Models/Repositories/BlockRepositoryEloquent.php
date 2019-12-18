<?php

namespace App\Models\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Repositories\BlockRepository;
use App\Models\Block;
use App\Models\Validators\BlockValidator;

/**
 * Class BlockRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class BlockRepositoryEloquent extends BaseRepository implements BlockRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Block::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BlockValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
