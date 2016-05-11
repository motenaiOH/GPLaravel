<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 18:10
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectNoteRepository;
use CodeProject\Validators\ProjectNoteValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ProjectNoteService
 * @package CodeProject\Services
 */
class ProjectNoteService
{
    /**
     * @var ProjectNoteRepository
     */
    protected $repository;
    /**
     * @var ProjectNoteValidator
     */
    protected $validator;

    /**
     * @param ProjectNoteRepository $repository
     * @param ProjectNoteValidator $validator
     */
    function __construct(ProjectNoteRepository $repository, ProjectNoteValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data,$project_id)
    {
        try {
            $data['project_id'] = $project_id;
            $this->validator->with($data)->passesOrFail();
            return $this->repository->create($data);
        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id,$noteId)
    {
        try {
            $data['project_id'] = $id;
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $noteId);

        } catch (ValidatorException $e) {
            return [
                'error' => true,
                'message' => $e->getMessageBag()
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying to update the data. Try again later.'
            ];
        }
    }

    public function show($id,$noteId)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id, 'id' => $noteId]);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying to update the data. Try again later.'
            ];
        }
    }

    public function index($id)
    {
        try {
            return $this->repository->findWhere(['project_id' => $id]);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying to find the data. Try again later.'
            ];
        }
    }

    public function delete($id,$noteId)
    {
        try {
            $this->repository->delete($noteId);
            return [
                'success' => true
            ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying to delete the data. Try again later.'
            ];
        }
    }


}