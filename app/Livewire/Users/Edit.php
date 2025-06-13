<?php

namespace App\Livewire\Users;

use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Edit extends Component
{
    public $user_id = "";
    public $fullname = "";
    public $email = "";
    public $current_assigned_roles = [];
    public $selectedRole = [];  
    public $availableRoles;

    public $selectedOption = '';

    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $userDetails = (new UserRepository())->findUser($user_id);
        $this->fullname = $userDetails->fullname;
        $this->email = $userDetails->email;
        $this->current_assigned_roles = $userDetails->roles->toArray();
        $this->availableRoles = (new RoleRepository())->allRolesWithoutPagination();
        $userRoles = $userDetails->roles;
        foreach($userRoles as $index => $role){
            $this->addRoleToSelection($role->id);
        }
    }

    public function rules()
    {
        return [];
    }

    public function messages()
    {
        return [];
    }

    private function roleExists($roles, $targetRoleName)
    {
        foreach($roles as $role){
            if(isset($role['name']) && $role['name'] === $targetRoleName){
                return true;
            }
        }
        return false;
    }

    public function addRoleToSelection($roleID)
    {
        $role = call_user_func_array('array_merge', array_filter($this->availableRoles->toArray(), function($role) use ($roleID) { 
            return $role['id'] == $roleID; 
        }));
        if(count($role) <= 0) {
            $this->dispatch("flash-alert", type: "warning", title: "Warning", message: "Something is wrong with role metadata!.");
            return;
        }
        if ($this->roleExists($this->selectedRole, $role['name'])) {
            $this->dispatch("flash-alert", type: "info", title: "Info", message: "You've already selected the role!.");
            return;
        }
        $this->selectedRole = [];
        $this->selectedRole = $role;
        $this->selectedOption = '';
    }

    public function updateUserDetails()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            $user = (new UserRepository())->findUser($this->user_id);
            $role = (new RoleRepository())->findRole($this->selectedRole["id"]);
            $user->attachRole($role);
            DB::commit();
            $this->dispatch("flash-alert", type: "success", title: "Success", message: "Role is successfully assigned to user!.");
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage());
        }
    }

    public function render()
    {
        $this->availableRoles = (new RoleRepository())->allRolesWithoutPagination();
        return view('livewire.users.edit');
    }
}
