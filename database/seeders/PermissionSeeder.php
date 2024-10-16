<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                # 1
                'name' => 'Statistics',
                'model' => 'Statistics',
            ],
            [
                # 2
                'name' => 'Roles',
                'model' => 'Role',
            ],
            [
                # 3
                'name' => 'Admins',
                'model' => 'Admin',
            ],
            [
                # 4
                'name' => 'Orders',
                'model' => 'Order',
            ],
            [
                # 5
                'name' => 'Products',
                'model' => 'Product',
            ],
            [
                # 6
                'name' => 'Brands',
                'model' => 'Brand',
            ],
            [
                # 7
                'name' => 'Categories',
                'model' => 'Category',
            ],
            [
                # 8
                'name' => 'Shipping',
                'model' => 'Shipping',
            ],
            [
                # 9
                'name' => 'Coupons',
                'model' => 'Coupon',
            ],
            [
                # 10
                'name' => 'Sliders',
                'model' => 'Slider',
            ],
            [
                # 11
                'name' => 'Pages',
                'model' => 'Page',
            ],
            [
                # 12
                'name' => 'Subscribers',
                'model' => 'Subscriber',
            ],
            [
                # 13
                'name' => 'Settings',
                'model' => 'Setting',
            ],
            [
                # 14
                'name' => 'Index Page Priority Settings',
                'model' => 'IndexPriority',
            ],
            [
                # 15
                'name' => 'Banners',
                'model' => 'Banner',
            ],
        ];

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Drop the table
        Permission::truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
