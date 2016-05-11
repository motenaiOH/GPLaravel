<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectTaskRepository;
use CodeProject\Services\ProjectTaskService;
use Illuminate\Http\Request;

/**
 * Class ProjectTaskController
 * @package CodeProject\Http\Controllers
 */
class ProjectTaskController extends Controller
{

    /**
     * @var ProjectTaskRepository
     */
    private $repository;
    /**
     * @var ProjectTaskService
     */
    private $service;

    /**
     * @param ProjectTaskRepository $repository
     * @param ProjectTaskService $service
     */
    function __construct(ProjectTaskRepository $repository, ProjectTaskService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }


    /**
     * @return mixed
     */
    public function index($id)
    {
        return $this->service->index($id);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request,$id)
    {
        return $this->service->create($request->all(),$id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id,$taskId)
    {
        return $this->service->show($id,$taskId);
    }

    /**
     * @param $id
     */
    public function destroy($id,$taskId)
    {
        return $this->service->delete($id,$taskId);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id,$taskId)
    {
        return $this->service->update($request->all(),$id,$taskId);
    }
}
