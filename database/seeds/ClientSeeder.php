<?php

use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(App\Models\Client::class, 20)->create()->each(function ($client) {
            factory(\App\Models\User::class, 1)->create([
                'userable_id' => $client->id,
                'userable_type' => \App\Models\Client::class
            ]);
            factory(\App\Models\ClientAccount::class)->create([
                'client_id' => $client->id
            ]);
        });
    }
}
