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
        $userPermissions = [
            "view.recommendation.history.chart",
            "view.recommendation.history",
            "delete.recommendation.history",
            "view.profile",
            "change.password"
        ];

        /**
         * Attach Permissions to Roles.
         */
        $roleAdmin = config('roles.models.role')::where('slug', '=', 'admin')->first();
        $roleUser = config('roles.models.role')::where('slug', '=', 'user')->first();
        foreach ($permissions as $permission) {
            $roleAdmin->attachPermission($permission);
            if(in_array($permission->slug, $userPermissions)){
                $roleUser->attachPermission($permission);
            }
        }
    }
}
