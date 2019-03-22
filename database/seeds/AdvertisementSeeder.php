<?php

use Illuminate\Database\Seeder;

class AdvertisementSeeder extends Seeder {
    /**
     * Run the advertisement seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Advertisement::class, 10)->create();
    }
}
