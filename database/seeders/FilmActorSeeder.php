<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FilmActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filmIds = DB::table('films')->pluck('id')->toArray();
        $actorIds = DB::table('actors')->pluck('id')->toArray();

        foreach ($filmIds as $filmId) {
            // Mezclamos los actores y tomamos entre 1 y 3 aleatorios
            $randomActors = (array) array_rand(array_flip($actorIds), rand(1, 3));
            foreach ($randomActors as $actorId) {
                DB::table('film_actor')->insert([
                    'film_id' => $filmId,
                    'actor_id' => $actorId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        $this->command->info("Relaciones film_actor creadas con éxito.");
    }
}

