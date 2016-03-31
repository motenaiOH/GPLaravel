<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 18:10
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ClientRepository;
use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ClientValidator;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ClientService
 * @package CodeProject\Services
 */
class ProjectService
{
    /**
     * @var ClientRepository
     */
    protected $repository;
    /**
     * @var ClientValidator
     */
    protected $validator;

    /**
     * @param ClientRepository $repository
     * @param ClientValidator $validator
     */
    function __construct(ProjectRepository $repository, ProjectValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        try {
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
    public function update(array $data, $id)
    {
        try {
            $this->validator->with($data)->passesOrFail();
            return $this->repository->update($data, $id);

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

    public function show($id)
    {
        try {
            return $this->repository->with(['owner', 'client'])->find($id);
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

    public function index()
    {
        try {
            return $this->repository->with(['owner', 'client'])->all();
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

    public function delete($id)
    {
        try {
            $this->repository->delete($id);
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