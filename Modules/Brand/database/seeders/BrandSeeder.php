<?php

namespace Modules\Category\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Brand\Models\Brand;
use Modules\Category\Models\Category;
use Modules\Brand\Database\Factories\BrandFactory;


class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BrandFactory::new()->count(10)->create();    }
}
