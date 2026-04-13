<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Owner;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        for ($i = 0; $i < 10; $i++) {
            Owner::create([
                'name' => fake()->firstName(),
                'surname' => fake()->lastName(),
                'phone' => fake()->phoneNumber(),
                'email' => fake()->unique()->safeEmail(),
                'address' => fake()->address(),
            ]);
        }
    }

}
