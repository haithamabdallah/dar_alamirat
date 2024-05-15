<?php

namespace Modules\Brand\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Brand\Models\Brand;
use Modules\Category\database\seeders\BrandSeeder;

class BrandDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([BrandSeeder::class]);
    }
}
