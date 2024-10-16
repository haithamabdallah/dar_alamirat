<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PermissionRole::truncate();
        Role::where('name', 'Data Entry')->first()->permissions()->sync(['5']);
        
        $allPermissionIds = Permission::all()->pluck('id')->toArray();
        Role::where('name', 'Super')->first()->permissions()->sync($allPermissionIds);
    }
}
