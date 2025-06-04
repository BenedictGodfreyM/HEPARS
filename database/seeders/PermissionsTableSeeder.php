<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Permission Types
         *
         */
        $Permissionitems = [
            [
                'name'        => 'Can View Accreditations',
                'slug'        => 'view.accreditations',
                'description' => 'Can view accreditations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Accreditations',
                'slug'        => 'create.accreditations',
                'description' => 'Can create new accreditations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Accreditations',
                'slug'        => 'edit.accreditations',
                'description' => 'Can edit accreditations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Accreditations',
                'slug'        => 'delete.accreditations',
                'description' => 'Can delete accreditations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Careers',
                'slug'        => 'view.careers',
                'description' => 'Can view careers',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Careers',
                'slug'        => 'create.careers',
                'description' => 'Can create new careers',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Careers',
                'slug'        => 'edit.careers',
                'description' => 'Can edit careers',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Careers',
                'slug'        => 'delete.careers',
                'description' => 'Can delete careers',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Combinations',
                'slug'        => 'view.combinations',
                'description' => 'Can view combinations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Combinations',
                'slug'        => 'create.combinations',
                'description' => 'Can create new combinations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Combinations',
                'slug'        => 'edit.combinations',
                'description' => 'Can edit combinations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Combinations',
                'slug'        => 'delete.combinations',
                'description' => 'Can delete combinations',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Fields',
                'slug'        => 'view.fields',
                'description' => 'Can view fields',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Fields',
                'slug'        => 'create.fields',
                'description' => 'Can create new fields',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Fields',
                'slug'        => 'edit.fields',
                'description' => 'Can edit fields',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Fields',
                'slug'        => 'delete.fields',
                'description' => 'Can delete fields',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Institutions',
                'slug'        => 'view.institutions',
                'description' => 'Can view institutions',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Institutions',
                'slug'        => 'create.institutions',
                'description' => 'Can create new institutions',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Institutions',
                'slug'        => 'edit.institutions',
                'description' => 'Can edit institutions',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Institutions',
                'slug'        => 'delete.institutions',
                'description' => 'Can delete institutions',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Programs',
                'slug'        => 'view.programs',
                'description' => 'Can view programs',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Programs',
                'slug'        => 'create.programs',
                'description' => 'Can create new programs',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Programs',
                'slug'        => 'edit.programs',
                'description' => 'Can edit programs',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Programs',
                'slug'        => 'delete.programs',
                'description' => 'Can delete programs',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Subjects',
                'slug'        => 'view.subjects',
                'description' => 'Can view subjects',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Subjects',
                'slug'        => 'create.subjects',
                'description' => 'Can create new subjects',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Subjects',
                'slug'        => 'edit.subjects',
                'description' => 'Can edit subjects',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Subjects',
                'slug'        => 'delete.subjects',
                'description' => 'Can delete subjects',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Profile',
                'slug'        => 'view.profile',
                'description' => 'Can view profile',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Change Password',
                'slug'        => 'change.password',
                'description' => 'Can change password',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Roles',
                'slug'        => 'view.roles',
                'description' => 'Can view roles',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Create Roles',
                'slug'        => 'create.roles',
                'description' => 'Can create new roles',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Edit Roles',
                'slug'        => 'edit.roles',
                'description' => 'Can edit roles',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Roles',
                'slug'        => 'delete.roles',
                'description' => 'Can delete roles',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Permissions',
                'slug'        => 'view.permissions',
                'description' => 'Can view permissions',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can View Users',
                'slug'        => 'view.users',
                'description' => 'Can view users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Assign Roles to Users',
                'slug'        => 'assign.roles.to.users',
                'description' => 'Can assign roles to users',
                'model'       => 'Permission',
            ],
            [
                'name'        => 'Can Delete Users',
                'slug'        => 'delete.users',
                'description' => 'Can delete users',
                'model'       => 'Permission',
            ],
        ];

        /*
         * Add Permission Items
         *
         */
        foreach ($Permissionitems as $Permissionitem) {
            $newPermissionitem = config('roles.models.permission')::where('slug', '=', $Permissionitem['slug'])->first();
            if ($newPermissionitem === null) {
                $newPermissionitem = config('roles.models.permission')::create([
                    'name'          => $Permissionitem['name'],
                    'slug'          => $Permissionitem['slug'],
                    'description'   => $Permissionitem['description'],
                    'model'         => $Permissionitem['model'],
                ]);
            }
        }
    }
}
