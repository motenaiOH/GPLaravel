<?php
/**
 * Created by PhpStorm.
 * User: OeMotenai
 * Date: 20/01/2016
 * Time: 20:47
 */

namespace CodeProject\Validators;


use Prettus\Validator\LaravelValidator;

class ProjectNoteValidator extends LaravelValidator
{
    protected $rules = [
        'project_id' => 'required|integer',
        'title' => 'required|max:255',
        'note' => 'required'
    ];
}