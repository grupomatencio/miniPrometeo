<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delegation;

class DelegationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //DEJAR DELEGACIÓN PROMETEO PARA CREAR SUPERUSER
        Delegation::create(['id' => 0, 'name' => 'Prometeo']);

        collect([
            'Benidorm',
        ])->each(function ($delegation) {
            Delegation::factory()->create(['name' => $delegation]);
        });
    }
}
