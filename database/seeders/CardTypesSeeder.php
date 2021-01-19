<?php

namespace Database\Seeders;

use App\Models\CardType;

class CardTypesSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/card_types.csv';
    protected static array $nullable_columns = [];
    protected static string $model = CardType::class;
    protected static $unique_by = 'id';
}
