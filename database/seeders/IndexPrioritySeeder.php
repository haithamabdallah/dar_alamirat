<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Category\Models\Banner;
use Modules\Category\Models\Category;

class IndexPrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::where('type','banner')?->delete();
        Category::where('type','default')?->get()?->each(function($category){
            $category->priority()->create([]);
        });
        Banner::all()?->each(function($banner){
            $banner->priority()->create([]);
        });
        // php artisan db:seed --class=IndexPrioritySeeder
    }
}
