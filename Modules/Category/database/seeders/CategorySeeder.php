<?php

namespace Modules\Category\database\seeders;

use Illuminate\Database\Seeder;
use Modules\Category\Models\Category;
use Modules\Category\database\seeders\CategoryDatabaseSeeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->count(10)->create();
    }
}
