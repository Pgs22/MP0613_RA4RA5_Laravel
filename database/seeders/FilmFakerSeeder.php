<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Se iimporta para usarlo en la implementación de los datos en la tabla

class FilmFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=5; $i++){
        DB::table('films')->insert(array(
        "name" => "film$i",
        "year" => 2020 + $i,
        "genre" => "genre$i",
        "duration" => 120 + $i,
        "country" => "España",
        "img_url" => "img/default.png",
        "created_at" => now(),
        "updated_at" => now()
        ));
        }
        $this->command->info("Mi tabla films ha sido rellenada por defecto");
    }
}
