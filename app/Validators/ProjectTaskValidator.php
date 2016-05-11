<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 20:47
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectTaskValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'start_date' => 'required|date',
        'due_date' => 'required|date',
        'status' => 'required'
    ];
}