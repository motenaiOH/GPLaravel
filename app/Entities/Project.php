<?php

namespace CodeProject\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Project extends Model
{

    protected $fillable = [
        'owner_id',
        'client_id',
        'name',
        'description',
        'progress',
        'status',
        'due_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(ProjectNote::class);
    }

    public function members()
    {

        return $this->belongsToMany(User::class, 'project_members', 'project_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(ProjectTask::class);
    }
}
