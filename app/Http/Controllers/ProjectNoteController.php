<?php

namespace CodeProject\Http\Controllers;

use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Services\ProjectNoteService;
use Illuminate\Http\Request;

/**
 * Class ProjectNoteController
 * @package CodeProject\Http\Controllers
 */
class ProjectNoteController extends Controller
{

    /**
     * @var ProjectNoteRepository
     */
    private $repository;
    /**
     * @var ProjectNoteService
     */
    private $service;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteService $service
     */
    function __construct(ProjectNoteRepository $repository, ProjectNoteService $service)
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
    public function show($id,$noteId)
    {
        return $this->service->show($id,$noteId);
    }

    /**
     * @param $id
     */
    public function destroy($id,$noteId)
    {
        return $this->service->delete($id,$noteId);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id,$noteId)
    {
        return $this->service->update($request->all(),$id,$noteId);
    }
}
