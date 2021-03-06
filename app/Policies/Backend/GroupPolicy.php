<?php

namespace App\Policies\Backend;

use App\Models\Acl\User;
use App\Models\Acl\Group;
use Illuminate\Auth\Access\HandlesAuthorization;

class GroupPolicy
{
    use HandlesAuthorization;
    protected $resource = 'admin.group';

    /**
     * Determine whether the user can view the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function index(User $user, Group $group)
    {
        $resource = $this->resource. '|index';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can create groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        $resource = $this->resource. '|create';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can store groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function store(User $user, Group $group)
    {
        $resource = $this->resource. '|store';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can show groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function show(User $user, Group $group)
    {
        $resource = $this->resource. '|show';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can edit groups.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function edit(User $user, Group $group)
    {
        $resource = $this->resource. '|edit';
        if(\Acl::isAllow($resource, $user))
        {
            return true;
        }
    }

    /**
     * Determine whether the user can update the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function update(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function delete(User $user, Group $group)
    {
        //
    }

    /**
     * Determine whether the user can delete the group.
     *
     * @param  \App\User  $user
     * @param  \App\Group  $group
     * @return mixed
     */
    public function destroy(User $user, Group $group)
    {
        //
    }
}
