<?php

namespace App\Livewire\Account;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password = "";
    public $password = "";

    public function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }

    public function setNewPassword()
    {
        $this->validate(); 
        try{
            DB::beginTransaction();
            if((new UserRepository)->change_password(Auth::user()->id, $this->current_password, $this->password)){
                DB::commit();
                $this->reset();
                $this->dispatch("flash-alert", type: "success", title: "Success", message: "Password is successfully changed!.");
            }else{
                DB::rollBack();
                $this->dispatch("flash-alert", type: "error", title: "Error", message: "Error in changing password!.");
            }
        }catch(Exception $e){
            DB::rollBack();
            $this->dispatch("flash-alert", type: "error", title: "Error", message: $e->getMessage()); 
        }
    }

    public function render()
    {
        return view('livewire.account.change-password');
    }
}
