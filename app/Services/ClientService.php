<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 18:10
 */

namespace CodeProject\Services;


use CodeProject\Entities\Project;
use CodeProject\Repositories\ClientRepository;
use CodeProject\Validators\ClientValidator;
use Illuminate\Validation\ValidationException;
use Prettus\Validator\Exceptions\ValidatorException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class ClientService
 * @package CodeProject\Services
 */
class ClientService
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
    function __construct(ClientRepository $repository, ClientValidator $validator)
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
        }
    }

    public function show($id)
    {
        try {
            return $this->repository->with('projects')->find($id);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'not founded'
            ];
        }

    }

    public function index()
    {
        try {
            return $this->repository->with('projects')->all();
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'no data'
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
        } catch (NotFoundHttpException $e) {
            return [
                'error' => true,
                'message' => 'not founded'
            ];
        }
    }
}