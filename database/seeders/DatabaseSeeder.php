<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ProductsSeeder::class,
            DecksSeeder::class,
            CardTypesSeeder::class,
            Ag2CategoryIconsSeeder::class,
            SpecialColorsSeeder::class,
            CardsSeeder::class,
            CardProductSeeder::class,
        ]);
    }
}
