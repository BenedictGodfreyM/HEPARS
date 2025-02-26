<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RoleRepository
{
    /**
     * Retrieve all roles from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allRoles()
    {
        return config('roles.models.role')::with(['users', 'permissions'])->latest()->paginate(10);
    }

    /**
     * Save details of a role to the database
     * 
     * @param array $data Details of a particular role
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function storeRole(array $data)
    {
        try{
            DB::beginTransaction();
            $newRole = config('roles.models.role')::create([
                'name'          => $data['name'],
                'slug'          => str_slug($data['name'], '.'),
                'description'   => $data['description'],
                'level'         => $data['level'],
            ]);
            foreach ($data["permissions"] as $permission_id) {
                $permission = config('roles.models.permission')::where('id', '=', $permission_id)->first();
                $newRole->attachPermission($permission);
            }
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Retrieve a role by its ID from the database
     * 
     * @param string $id role ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findUser($id)
    {
        return config('roles.models.role')::with(['users', 'permissions'])->where('id', '=', $id)->firstOrFail();
    }

    /**
     * Update the general details of a role
     * 
     * @param array $data Details of a particular role
     * @param string $id user ID
     * 
     * @return boolean
     */
    public function updateRole(array $data, string $id)
    {
        $role = config('roles.models.role')::find($id);
        $role->name = $data["name"];
        $role->slug = str_slug($data["name"], '.');
        $role->description = $data["description"];
        $role->level = $data["level"];
        return $role->save();
    }

    /**
     * Permanently, delete a role from the database
     * 
     * @param string $id role ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyRole($id)
    {
        $role = config('roles.models.role')::find($id);
        $role->detachAllPermissions();
        return $role->delete();
    }

    /**
     * Add permissions to a role
     * 
     * @param array $data array of IDs of specific permissions
     * @param string $role_id
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function add_permissions(array $data, string $role_id){
        $role = config('roles.models.role')::find($role_id);
        try{
            DB::beginTransaction();
            foreach ($data["permissions"] as $permission_id) {
                $permission = config('roles.models.permission')::where('id', '=', $permission_id)->first();
                $role->attachPermission($permission);
            }
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Remove permissions from a role
     * 
     * @param array $data array of IDs of specific permissions
     * @param string $role_id
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function remove_permissions(array $data, string $role_id){
        $role = config('roles.models.role')::find($role_id);
        try{
            DB::beginTransaction();
            foreach ($data["permissions"] as $permission_id) {
                $permission = config('roles.models.permission')::where('id', '=', $permission_id)->first();
                $role->detachPermission($permission);
            }
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }
    
    /**
     * Remove all permissions from a role
     * 
     * @param string $role_id
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function remove_all_permissions($role_id)
    {
        $role = config('roles.models.role')::find($role_id);
        try{
            DB::beginTransaction();
            $role->detachAllPermissions();
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }
}