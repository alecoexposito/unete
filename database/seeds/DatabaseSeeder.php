<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->call('BusinessCategorySeeder');
        $this->call('BusinessSeeder');
        $this->call('ClientSeeder');
        $this->call('AdvertisementSeeder');
    }
}
