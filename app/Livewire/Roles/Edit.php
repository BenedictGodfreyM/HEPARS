<?php

namespace App\Livewire\Roles;

use App\Repositories\PermissionRepository;
use App\Repositories\RoleRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $role_id = "";
    public $name = ""; 
    public $description = "";    
    public $level = "";   
    public $selectedPermissions = [];  
    public $availablePermissions;

    public $selectedOption = '';

    public function mount($role_id)
    {
        $this->role_id = $role_id;
        $roleDetails = (new RoleRepository())->findRole($role_id);
        $this->name = $roleDetails->name;
        $this->description = $roleDetails->description;
        $this->level = $roleDetails->level;
        $this->availablePermissions = (new PermissionRepository())->allPermissionsWithoutPagination();
        $rolePermissions = $roleDetails->permissions;
        foreach($rolePermissions as $index => $permission){
            $this->addPermissionToSelection($permission->id);
        }
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,id|max:40',
            'description' => 'nullable|string|max:191',
            'level' => 'required|numeric|min:0|max:14',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please insert the name of the role.',
            'name.string' => 'The name of the role should be in alphanumeric characters.',
            'name.unique' => 'The name of the role already exists.',
            'name.max' => 'The name of the role should have atmost 40 characters.',
            'description.string' => 'The description of the role should be in alphanumeric characters.',
            'description.max' => 'The description of the role should have atmost 191 characters.',
            'level.required' => 'Please insert the level of the role.',
            'level.numeric' => 'The level of the role should be in digits.',
            'level.min' => 'The lowest level of the role should be 0.',
            'level.max' => 'The highest level of the role should be 14.',
        ];
    }

    private function permissionExists($permissions, $targetPermissionName)
    {
        foreach($permissions as $permission){
            if(isset($permission['name']) && $permission['name'] === $targetPermissionName){
                return true;
            }
        }
        return false;
    }

    public function addPermissionToSelection($permissionID)
    {
        $permission = call_user_func_array('array_merge', array_filter($this->availablePermissions->toArray(), function($permission) use ($permissionID) { 
            return $permission['id'] == $permissionID; 
        }));
        if(count($permission) <= 0) {
            $this->dispatch("flash-alert", type: "warning", title: "Warning", message: "Something is wrong with permission metadata!.");
            return;
        }
        if ($this->permissionExists($this->selectedPermissions, $permission['name'])) {
            $this->dispatch("flash-alert", type: "info", title: "Info", message: "You've already selected the permission!.");
            return;
        }
        $this->selectedPermissions[] = $permission;
        $this->selectedOption = '';
    }

    public function removePermissionFromSelection($index)
    {
        unset($this->selectedPermissions[$index]);
        $this->selectedPermissions = array_values($this->selectedPermissions);
    }

    public function updateRoleDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $roleRepo = new RoleRepository();
            $isUpdated = $roleRepo->updateRole([
                'name' => $this->name,
                'description' => $this->description,
                'level' => $this->level,
            ], $this->role_id);
                
            $allPermissionsRemoved = $roleRepo->remove_all_permissions($this->role_id);
            $newPermissionsAdded = $roleRepo->add_permissions(array_pluck($this->selectedPermissions, "id"), $this->role_id);
            
            if($isUpdated && $allPermissionsRemoved && $newPermissionsAdded){
                DB::commit();
                $this->dispatch("flash-alert", type: "success", title: "Success", message: "Role is successfully updated!.");
            }else{
                DB::rollBack();
                $this->dispatch("flash-alert", type: "error", title: "Error", message: "Unable to update role details! Try again later.");  
            }
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }
    }

    public function render()
    {
        $this->availablePermissions = (new PermissionRepository())->allPermissionsWithoutPagination();
        return view('livewire.roles.edit');
    }
}
