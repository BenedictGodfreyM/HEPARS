<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PermissionRepository
{
    /**
     * Retrieve all permissions from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allPermissions()
    {
        return config('roles.models.permission')::with('users', 'roles')->latest()->paginate(10);
    }

    /**
     * Retrieve a permission by its ID from the database
     * 
     * @param string $id permission ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findPermission($id)
    {
        return config('roles.models.permission')::with('users', 'roles')->where('id', '=', $id)->firstOrFail();
    }
}