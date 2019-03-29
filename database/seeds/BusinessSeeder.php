<?php

use App\Models\BusinessCategory;
use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $categories = BusinessCategory::all()->pluck('id')->toArray();
        factory(App\Models\Business::class, 20)->create()->each(function ($business) use ($categories) {
            $categoryId = array_random($categories);
            $business->categories()->attach($categoryId);

            $autoIncrement = $this->autoIncrement();
            factory(\App\Models\ClientType::class, 3)->make(['business_id' => $business->id])->each(function($clientType) use ($autoIncrement) {
                $autoIncrement->next();
                $clientType->order = $autoIncrement->current();
                $clientType->save();
            });

            $autoIncrement = $this->autoIncrement();
            $amount = random_int(1, 2);
            factory(\App\Models\Dependence::class, $amount)->make([
                'business_id' => $business->id,
            ])->each(function ($dependence) use ($business, $autoIncrement) {
                $autoIncrement->next();
                $dependence->name = $business->name . " " . $autoIncrement->current();
                $dependence->main = $autoIncrement->current() == 1 ? true : false;
                $dependence->save();
                $account = factory(\App\Models\BusinessAccount::class, 1)->create(['dependence_id' => $dependence->id]);
                $clientTypes = \App\Models\ClientType::query()->where(['business_id' => $business->id])->get();
                $clientTypes->each(function ($clientType) use ($dependence) {
                    factory(\App\Models\ClientTypeDependence::class, 1)->create([
                        'client_type_id' => $clientType->id,
                        'dependence_id' => $dependence->id
                    ]);
                });
            });

        });


    }

    private function autoIncrement()
    {
        for ($i = 0; $i < 1000; $i++) {
            yield $i;
        }
    }
}
