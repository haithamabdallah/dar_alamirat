<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Modules\Admin\app\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

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

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Role::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        foreach ($roles as $role) {
            Role::firstOrCreate( $role );
        }

        Admin::where('name', 'Super')->update([
            'role_id' => Role::where('name', 'Super')->first()->id
        ]);

        
    }
}
