<?php

namespace App\Policies;

use App\Models\Model;
use App\Models\User;
use App\Models\ServiceCategory;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Contracts\Auth\Access\Gate;

class Policy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return true;
    }

    public function viewAny(User $user)
    {
        return true;
    }

    public function edit(User $user, Model $model)
    {
        return $model->isOwn($user);
    }

    public function update(User $user, Model $model)
    {
        return $model->isOwn($user);
    }

    public function delete(User $user, Model $model)
    {
        return $model->isOwn($user);
    }
}
