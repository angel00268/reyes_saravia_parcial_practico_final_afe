<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class SellerSeeder extends Seeder
{
    public function run()
    {
        $this->faker = Faker::create();

        Seller::create([
            'user_id' => 1,
            'dui' => $this->faker->numerify('#########'),
            'nit' => $this->faker->numerify('##############'),
            'address' => $this->faker->address(),
        ]);

        Seller::create([
            'user_id' => 2,
            'dui' => $this->faker->numerify('#########'),
            'nit' => $this->faker->numerify('##############'),
            'address' => $this->faker->address(),
        ]);

        Seller::create([
            'user_id' => 3,
            'dui' => $this->faker->numerify('#########'),
            'nit' => $this->faker->numerify('##############'),
            'address' => $this->faker->address(),
        ]);

        Seller::create([
            'user_id' => 4,
            'dui' => $this->faker->numerify('#########'),
            'nit' => $this->faker->numerify('##############'),
            'address' => $this->faker->address(),
        ]);
    }
}
