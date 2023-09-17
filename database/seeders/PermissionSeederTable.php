<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\AdminAccess;
use Illuminate\Database\Seeder;

class PermissionSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'group_name' => 'Setting',
                'permission_name' => [
                    'settingUpdate',
                ]
            ],
        ];
        foreach ($permissions as $permission) {
            foreach ($permission['permission_name'] as $permissionName) {
                Permission::create(['permissions' => $permissionName, 'group_name' => $permission['group_name']]);
            }
        }

        $allPermissions = Permission::all();
        foreach ($allPermissions as $perm) {
            AdminAccess::create([
                'admin_id'    => 1,
                'group_name'  => $perm->group_name,
                'permissions' => $perm->permissions,
            ]);
        }
    }
}
