<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 18:10
 */

namespace CodeProject\Services;


use CodeProject\Repositories\ProjectRepository;
use CodeProject\Validators\ProjectValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ProjectService
 * @package CodeProject\Services
 */
class ProjectService
{
    /**
     * @var ProjectRepository
     */
    protected $repository;
    /**
     * @var ProjectValidator
     */
    protected $validator;

    /**
     * @param ProjectRepository $repository
     * @param ProjectValidator $validator
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
            return $this->repository->with(['owner', 'client','members','notes','tasks'])->find($id);
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying find the data. Try again later.'
            ];
        }
    }

    public function index()
    {
        try {
            return $this->repository->with(['owner', 'client','members','notes','tasks'])->all();
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

    public function addMember($id,$memberId){
        try {
            $project =  $this->repository->find($id);
            if(!$this->isMember($id,$memberId))
            {
                $project->members()->attach($memberId);
            }
            else
                return [
                    'error' => true,
                    'message' => 'This user already takes part in this project.'
                ];

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
                'message' => 'An error occurred when trying find the data. Try again later.'
            ];
        }
    }

    public function removeMember($id,$memberId){
        try {
            $project =  $this->repository->find($id);
            if($this->isMember($id,$memberId))
            {
                $project->members()->detach($memberId);
            }
            else
                return [
                    'error' => true,
                    'message' => 'This user don\'t take part in this project.'
                ];

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
                'message' => 'An error occurred when trying find the data. Try again later.'
            ];
        }
    }

    public function members($id){
        try {
            return  $this->repository->with(['members'])->find($id)->members()->get();
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying find the data. Try again later.'
            ];
        }
    }

    public function member($id,$memberId){
        try {
            if($this->isMember($id,$memberId))
                return $this->repository->with(['members'])->find($id)->members()->get()->find($memberId);
            else
                return [
                    'error' => true,
                    'message' => 'No data found.'
                ];
        } catch (ModelNotFoundException $e) {
            return [
                'error' => true,
                'message' => 'No data found.'
            ];
        } catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying find the data. Try again later.'
            ];
        }
    }

    public function isMember($id, $memberId){
        try{
            return $this->repository->with(['members'])->find($id)->members()->get()->find($memberId) !== null;

        }catch (\Exception $e) {
            return [
                'error' => true,
                'message' => 'An error occurred when trying to delete the data. Try again later.'
            ];
        }
    }

}