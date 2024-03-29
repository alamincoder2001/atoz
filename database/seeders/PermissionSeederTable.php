<?php

namespace Database\Seeders;

use App\Models\Permission;
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
                'group_name' => 'Dashboard',
                'permission_name' => [
                    'Dashboard',
                ]
            ],
            [
                'group_name' => 'Setting',
                'permission_name' => [
                    'settingUpdate',
                ]
            ],
            [
                'group_name' => 'AreaManager',
                'permission_name' => [
                    'areaManagerEntry',
                ]
            ],
            [
                'group_name' => 'Banner',
                'permission_name' => [
                    'bannerEntry',
                ]
            ],
            [
                'group_name' => 'Slider',
                'permission_name' => [
                    'sliderEntry',
                ]
            ],
            [
                'group_name' => 'Category',
                'permission_name' => [
                    'categoryEntry',
                ]
            ],
            [
                'group_name' => 'NewsEvent',
                'permission_name' => [
                    'newsandeventEntry',
                ]
            ],
            [
                'group_name' => 'Partner',
                'permission_name' => [
                    'partnerEntry',
                ]
            ],
            [
                'group_name' => 'Service',
                'permission_name' => [
                    'serviceEntry',
                ]
            ],
            [
                'group_name' => 'District',
                'permission_name' => [
                    'districtEntry',
                ]
            ],
            [
                'group_name' => 'Thana',
                'permission_name' => [
                    'thanaEntry',
                ]
            ],
            [
                'group_name' => 'Customer',
                'permission_name' => [
                    'customerList',
                ]
            ],
            [
                'group_name' => 'Worker',
                'permission_name' => [
                    'workerEntry',
                    'assignWorkerService',
                ]
            ],
            [
                'group_name' => 'User',
                'permission_name' => [
                    'userEntry',
                    'userAccess',
                ]
            ],
            [
                'group_name' => 'Report',
                'permission_name' => [
                    'reportShow',
                    'paymentShow',
                    'commissionList',
                    'paymentCollection'
                ]
            ],
            [
                'group_name' => 'Order',
                'permission_name' => [
                    'orderList',
                    'orderAssign',
                    'orderComplete',
                    'orderCancel',
                ]
            ],
        ];
        foreach ($permissions as $permission) {
            foreach ($permission['permission_name'] as $permissionName) {
                Permission::create(['permissions' => $permissionName, 'group_name' => $permission['group_name']]);
            }
        }
    }
}
