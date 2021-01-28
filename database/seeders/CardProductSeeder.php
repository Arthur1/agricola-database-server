<?php

namespace Database\Seeders;

class CardProductSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/card_product.csv';
    protected static array $nullable_columns = [];
    protected static string $table_name = 'card_product';
    protected static $unique_by = ['card_id', 'product_id'];
}
