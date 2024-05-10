<?php

namespace Modules\Admin\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Admin\app\Models\Admin;

class AdminRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $admin = Admin::updateOrCreate([
            'id'        => 1,
            'userName'  => 'admin',
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'phone'     => '0123456789',
            'password'  => '123456789',
            'system'    => 1,
        ]);

        $admin->assignRole('admin');
    }
}
