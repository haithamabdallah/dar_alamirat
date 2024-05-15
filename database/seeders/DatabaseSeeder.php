<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Admin\database\seeders\AdminRolesSeeder;
use Modules\Category\database\seeders\BrandSeeder;
use Modules\Roles\database\seeders\PermissionSeeder;
use Modules\Category\database\seeders\CategorySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            PermissionSeeder::class,
            AdminRolesSeeder::class,
            SettingSeeder::class,
         //   CategorySeeder::class,
         //   BrandSeeder::class,
        ]);

    }
}
