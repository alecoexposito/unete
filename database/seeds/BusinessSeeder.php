<?php

use App\Models\BusinessCategory;
use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = BusinessCategory::all()->pluck('id')->toArray();
        factory(App\Models\Business::class, 20)->create()->each(function($business) use ($categories) {
            $categoryId = array_random($categories);
            $business->categories()->attach($categoryId);
            factory(\App\Models\Dependence::class, 1)->create(['business_id' => $business->id])->each(function($dependence) use ($business) {
                $account = factory(\App\Models\BusinessAccount::class, 1)->create(['dependence_id' => $dependence->id]);
            });
        });
    }
}
