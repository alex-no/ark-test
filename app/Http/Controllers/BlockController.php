<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\BlockCreateRequest;
use App\Http\Requests\BlockUpdateRequest;
use App\Models\Repositories\BlockRepository;
use App\Models\Validators\BlockValidator;

/**
 * Class BlocksController.
 *
 * @package namespace App\Http\Controllers;
 */
class BlockController extends Controller
{
    /**
     * @var BlockRepository
     */
    protected $repository;

    /**
     * @var BlockValidator
     */
    protected $validator;

    /**
     * BlocksController constructor.
     *
     * @param BlockRepository $repository
     * @param BlockValidator $validator
     */
    public function __construct(BlockRepository $repository, BlockValidator $validator)
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
        $blocks = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $blocks,
            ]);
        }

        return view('blocks.index', compact('blocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BlockCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BlockCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $block = $this->repository->create($request->all());

            $response = [
                'message' => 'Block created.',
                'data'    => $block->toArray(),
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
        $block = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $block,
            ]);
        }

        return view('blocks.show', compact('block'));
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
        $block = $this->repository->find($id);

        return view('blocks.edit', compact('block'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BlockUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BlockUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $block = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Block updated.',
                'data'    => $block->toArray(),
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
                'message' => 'Block deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Block deleted.');
    }
}
