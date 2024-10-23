<?php

namespace Database\Seeders;

use App\Models\Todo;
use App\Models\User;
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

        // Nous allons afficher tous les utilisateurs
        $users = User::all();

        foreach ($users as $user) {
            // Pour chaque utilisateur, on crée 4todos
            for ($i = 0; $i < 4; $i++) {
                Todo::create([
                    'user_id' => $user->id,
                    'name' => $faker->sentence(3, true),
                    'completed' => $faker->boolean(50),
                    'completed_at' => $faker->boolean(50) ? $faker->dateTimeBetween('-1 month', 'now') : null,
                    'created_at' => $faker->dateTimeBetween('-1 month', 'now'),
                    'updated_at' => $faker->dateTimeBetween('-1 month', 'now'),
                ]);
            }
        }
    }
}
