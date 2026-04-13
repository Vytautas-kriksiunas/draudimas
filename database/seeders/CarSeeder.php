<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Owner;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Owner::all() as $owner) {
            for ($i = rand(1, 3); $i > 0; $i--) {
                Car::create([
                    'reg_number' => fake()->bothify('???-###'),
                    'brand' => fake()->randomElement(['Toyota', 'BMW', 'Audi', 'Honda', 'Ford']),
                    'model' => fake()->randomElement(['Corolla', 'X5', 'A4', 'Civic', 'Focus']),
                    'owner_id' => $owner->id,
                ]);
            }
        }
    }
}
