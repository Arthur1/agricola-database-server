<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use SplFileObject;

class CsvSeeder extends Seeder
{
    protected static string $file_path;
    protected static array $nullable_columns;
    protected static string $model;
    protected static $unique_by;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject(database_path(static::$file_path));
        $file->setFlags(
            SplFileObject::READ_CSV |
            SplFileObject::READ_AHEAD |
            SplFileObject::SKIP_EMPTY |
            SplFileObject::DROP_NEW_LINE
        );

        // header
        $header = $file->current();
        $file->next();

        // data
        $values = [];
        while ($file->valid()) {
            $value = array_combine($header, $file->current());
            foreach (static::$nullable_columns as $column) {
                if ($value[$column] === '') {
                    $value[$column] = null;
                }
            }
            $values[] = $value;
            $file->next();
        }

        static::$model::upsert($values, static::$unique_by);
    }
}
