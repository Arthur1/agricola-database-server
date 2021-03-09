<?php

namespace Database\Seeders;

class CardRepublishedSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/card_republished.csv';
    protected static array $nullable_columns = [];
    protected static string $table_name = 'card_republished';
    protected static $unique_by = ['card_id', 'origin_card_id'];
}
