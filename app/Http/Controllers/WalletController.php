<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\WalletCreateRequest;
use App\Http\Requests\WalletUpdateRequest;
use App\Models\Repositories\WalletRepository;
use App\Models\Validators\WalletValidator;

/**
 * Class WalletsController.
 *
 * @package namespace App\Http\Controllers;
 */
class WalletController extends Controller
{
    /**
     * @var WalletRepository
     */
    protected $repository;

    /**
     * @var WalletValidator
     */
    protected $validator;

    /**
     * WalletsController constructor.
     *
     * @param WalletRepository $repository
     * @param WalletValidator $validator
     */
    public function __construct(WalletRepository $repository, WalletValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $wallets = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $wallets,
            ]);
        }

        return view('wallets.index', compact('wallets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wallet = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $wallet,
            ]);
        }

        return view('wallets.show', compact('wallet'));
    }
}
