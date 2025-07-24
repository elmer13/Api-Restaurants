<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Restaurant;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Restaurant::create([
            'name' => 'La font de prades',
            'address' => 'Av. de Francesc Ferrer, 13, 08038 Barcelona',
            'phone' => '+34601436899',
        ]);

        Restaurant::factory(10)->create();
    }
}
