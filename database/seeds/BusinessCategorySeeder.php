<?php

use Illuminate\Database\Seeder;

class BusinessCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\BusinessCategory::class, 5)->create()->each(function($category) {
            $category->subcategories()->save(factory(App\Models\BusinessCategory::class)->make());
            $category->subcategories()->save(factory(App\Models\BusinessCategory::class)->make());
        });
    }
}
