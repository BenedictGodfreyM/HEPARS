<?php

namespace App\Repositories;

use App\Models\Recommendation;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    /**
     * Get the total number of users in the database
     * 
     * @return integer
     */
    public function totalUsers()
    {
        return User::count();
    }

    /**
     * Retrieve all users from the database
     * 
     * @return Illuminate\Pagination\LengthAwarePaginator
     */
    public function allUsers($search, $sortField = "firstname", $sortDirection = "desc", $perPage = 10)
    {
        return User::where('firstname', 'like', '%' . $search . '%')
                    ->orWhere('surname', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orderBy($sortField, $sortDirection)
                    ->paginate($perPage);
    }

    /**
     * Save details of a user to the database
     * 
     * @param array $data Details of a particular user
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function storeUser(array $data)
    {
        return User::create([
            'firstname' => $data['firstname'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'profile_photo' => $data['profile_photo'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Retrieve a user by its ID from the database
     * 
     * @param string $id user ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function findUser($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Update the general details of a user
     * 
     * @param array $data Details of a particular user
     * @param string $id user ID
     * 
     * @return boolean
     */
    public function updateUser(array $data, string $id)
    {
        $user = User::where('id', $id)->firstOrFail();
        $user->firstname = $data['firstname'];
        $user->surname = $data['surname'];
        return $user->save();
    }

    /**
     * Change user password
     * 
     * @param string $user_id
     * @param string $old_password
     * @param string $new_password
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function change_password($user_id, $old_password, $new_password){
        $user = User::findOrFail($user_id);
        if(Hash::check($old_password, $new_password)){
            return $user->fill(['password' => Hash::make($new_password)])->save();
        }else{
            return false;
        }
    }

    /**
     * Permanently, delete a user from the database
     * 
     * @param string $id user ID
     * 
     * @return integer Number of records deleted (0 for none)
     */
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();
    }

    /**
     * Save User's Recommendations
     * 
     * @param array $data Details of a particular recommendation
     * @param string $user_id User ID
     * 
     * @return Illuminate\Database\Eloquent\Model
     */
    public function saveRecommendation(array $data, string $user_id)
    {
        $user = User::findOrFail($user_id);
        return $user->recommendations()->create([
            'acsee_results' => $data['acsee_results'],
            'career_choice' => $data['career_choice'],
            'programs' => $data['programs'],
        ]);
    }

    /**
     * Assign roles to a particular user
     * 
     * @param array $data array of IDs of specific roles
     * @param string $user_id user ID
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function assign_roles(array $data, string $user_id){
        try{
            DB::beginTransaction();
            $user = config('roles.models.defaultUser')::find($user_id);
            foreach ($data as $role_id) {
                $role = config('roles.models.role')::where('id', '=', $role_id)->first();
                $user->attachRole($role);
            }
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }

    /**
     * Remove roles from a particular user
     * 
     * @param array $data array of IDs of specific roles
     * @param string $user_id user ID
     * 
     * @return boolean True, for a successful operation, and False, for otherwise
     */
    public function remove_roles(array $data, string $user_id){
        try{
            DB::beginTransaction();
            $user = config('roles.models.defaultUser')::find($user_id);
            foreach ($data as $role_id) {
                $role = config('roles.models.role')::where('id', '=', $role_id)->first();
                $user->detachRole($role);
            }
            DB::commit();
            return true;
        } catch (\Exception $exp) {
            DB::rollBack();
            return false;
        }
    }
}