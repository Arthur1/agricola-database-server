<?php

namespace Database\Seeders;

use App\Models\Card;

class CardsSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/cards.csv';
    protected static array $nullable_columns = [
        'playagricola_card_id',
        'deck_id',
        'min_players_number',
        'imp_prereq',
        'imp_cost',
        'ag2_category_icon_id',
        'special_color_id',
    ];
    protected static string $model = Card::class;
    protected static $unique_by = 'id';
}
