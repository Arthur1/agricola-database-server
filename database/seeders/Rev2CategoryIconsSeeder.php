<?php

namespace Database\Seeders;

use App\Models\Rev2CategoryIcon;

class Rev2CategoryIconsSeeder extends CsvSeeder
{
    protected static string $file_path = 'seeds/rev2_category_icons.csv';
    protected static array $nullable_columns = [];
    protected static string $model = Rev2CategoryIcon::class;
    protected static $unique_by = 'id';
}
