<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(DelegationSeeder::class);
        $this->call(LocalSeeder::class);
        $this->call(ZonasSeeder::class);
    }
}
