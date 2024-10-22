<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;

class todosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

            for ($i = 0; $i < 20; $i++) {
                Todo::create([
                    'name' => $faker->sentence(3, true),
                    'completed' => $faker->boolean(50),
                    'completed_at' => $faker->boolean(50) ? $faker->dateTimeBetween('-1 month', 'now') : null,
                    'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
                ]);
            }
    }
}
