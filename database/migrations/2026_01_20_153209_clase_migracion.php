<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
/*        "name": "La Rosa P\u00farpura del Cairo",
        "year": 1985,
        "genre": "Drama",
        "duration": 120,
        "country": "Espa\u00f1a",
        "img_url"*/

        Schema::create('films', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->unsignedBigInteger('year');
        $table->string('genre');
        $table->unsignedBigInteger('duration');
        $table->string('country');
        $table->text('img_url');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('films');
    }
};
