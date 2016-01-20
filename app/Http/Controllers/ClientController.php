<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use Illuminate\Http\Request;

/**
 * Class ClientController
 * @package CodeProject\Http\Controllers
 */
class ClientController extends Controller
{

    /**
     * @var ClientRepository
     */
    private $repository;

    function __construct(ClientRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
//        dd($request->all());//Dump and die
        return $this->repository->create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->repositoryp->find($id);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        $this->repository->find($id)->delete();
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return $this->repository->find($id)->save($request);
    }
}
