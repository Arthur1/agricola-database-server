<?php

namespace Database\Seeders;

use App\Models\Deck;

class DecksSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/decks.csv';
    protected static array $nullable_columns = [];
    protected static string $model = Deck::class;
    protected static $unique_by = 'id';
}
