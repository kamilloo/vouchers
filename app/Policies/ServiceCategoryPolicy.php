<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ServiceCategory;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceCategoryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function create(User $user)
    {
        return true;
    }

    public function edit(User $user, ServiceCategory $service_category)
    {
        return $service_category->isOwn($user);
    }

    public function update(User $user, ServiceCategory $service_category)
    {
        return $service_category->isOwn($user);
    }

    public function delete(User $user, ServiceCategory $service_category)
    {
        return $service_category->isOwn($user);
    }
}
