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
    public function allPermissions($search, $sortField = "status", $sortDirection = "desc", $perPage = 10)
    {
        return config('roles.models.permission')::with('users', 'roles')
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%')
                        ->orWhere('description', 'like', '%' . $search . '%')
                        ->orWhere('model', 'like', '%' . $search . '%')
                        ->orderBy($sortField, $sortDirection)
                        ->paginate($perPage);
    }

    /**
     * Retrieve all permissions from the database (Without Pagination)
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allPermissionsWithoutPagination()
    {
        return config('roles.models.permission')::with(['users', 'roles'])->get();
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