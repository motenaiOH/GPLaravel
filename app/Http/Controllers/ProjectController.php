<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ClientRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Services\ClientService;
use CodeProject\Services\ProjectService;
use Illuminate\Http\Request;

/**
 * Class ProjectController
 * @package CodeProject\Http\Controllers
 */
class ProjectController extends Controller
{

    /**
     * @var ProjectRepository
     */
    private $repository;
    /**
     * @var ProjectService
     */
    private $service;

    /**
     * @param ProjectRepository $repository
     * @param ProjectService $service
     */
    function __construct(ProjectRepository $repository, ProjectService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * @return mixed
     */
    public function index()
    {
        return $this->service->index();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        return $this->service->create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        return $this->service->show($id);
    }

    /**
     * @param $id
     */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }


    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        return $this->service->update($request->all(),$id);
    }

    /**
     * @param $id
     * @param null $memberId
     */
    public function members($id){
        return $this->service->members($id);
    }

    public function member($id,$memberId){
        return $this->service->member($id,$memberId);
    }

    public function addMember($id,$memberId){
        return $this->service->addMember($id,$memberId);
    }

    public function removeMember($id,$memberId){
        return $this->service->removeMember($id,$memberId);
    }
}
