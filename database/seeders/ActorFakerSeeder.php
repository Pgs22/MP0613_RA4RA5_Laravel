<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //Se iimporta para usarlo en la implementación de los datos en la tabla

class ActorFakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i=1; $i<=10; $i++){
            DB::table('actors')->insert(array(
                "name" => "Actor$i",
                "surname" => "Apellido$i",
                "birthdate" => "199$i-01-01",
                "country" => "USA",
                "img_url" => "img/default.png",
                "created_at" => now(),
                "updated_at" => now()
            ));
        }
        $this->command->info("Mi tabla actors ha sido rellenada por defecto");
    }
}
