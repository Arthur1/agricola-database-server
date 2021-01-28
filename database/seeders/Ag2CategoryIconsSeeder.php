<?php

namespace Database\Seeders;

use App\Models\Ag2CategoryIcon;

class Ag2CategoryIconsSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/ag2_category_icons.csv';
    protected static array $nullable_columns = [];
    protected static string $model = Ag2CategoryIcon::class;
    protected static $unique_by = 'id';
}
