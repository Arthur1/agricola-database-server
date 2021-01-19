<?php

namespace Database\Seeders;

use App\Models\Product;

class ProductsSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/products.csv';
    protected static array $nullable_columns = [
        'published_year',
    ];
    protected static string $model = Product::class;
    protected static $unique_by = 'id';
}
