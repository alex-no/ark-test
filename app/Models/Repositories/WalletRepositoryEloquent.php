<?php

namespace App\Models\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Models\Repositories\WalletRepository;
use App\Models\Wallet;
use App\Models\Validators\WalletValidator;

/**
 * Class WalletRepositoryEloquent.
 *
 * @package namespace App\Models\Repositories;
 */
class WalletRepositoryEloquent extends BaseRepository implements WalletRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Wallet::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return WalletValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
