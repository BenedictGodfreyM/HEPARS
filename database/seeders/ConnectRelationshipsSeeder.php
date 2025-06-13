<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ConnectRelationshipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Get Available Permissions.
         */
        $permissions = config('roles.models.permission')::all();

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('slug', '=', 'admin')->first();
        $roleUser = config('roles.models.role')::where('slug', '=', 'user')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
            if(in_array($permission->id, ["29","30"])){
                $roleUser->attachPermission($permission);
            }
        }
    }
}
