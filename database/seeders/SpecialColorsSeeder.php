<?php

namespace Database\Seeders;

use App\Models\SpecialColor;

class SpecialColorsSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/special_colors.csv';
    protected static array $nullable_columns = [];
    protected static string $model = SpecialColor::class;
    protected static $unique_by = 'id';
}
