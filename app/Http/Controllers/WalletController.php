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
     * Store a newly created resource in storage.
     *
     * @param  WalletCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(WalletCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $wallet = $this->repository->create($request->all());

            $response = [
                'message' => 'Wallet created.',
                'data'    => $wallet->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wallet = $this->repository->find($id);

        return view('wallets.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  WalletUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(WalletUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $wallet = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Wallet updated.',
                'data'    => $wallet->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Wallet deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Wallet deleted.');
    }
}
