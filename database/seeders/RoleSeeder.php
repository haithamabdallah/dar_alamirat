<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Admin\app\Models\Admin;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Data Entry',
            ],
            [
                'name' => 'Super',
            ],
        ];

        Role::truncate();
        foreach ($roles as $role) {
            Role::firstOrCreate( $role );
        }

        Admin::where('name', 'Super')->update([
            'role_id' => Role::where('name', 'Super')->first()->id
        ]);

        
    }
}
