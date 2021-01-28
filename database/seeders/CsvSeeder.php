<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use SplFileObject;

class CsvSeeder extends Seeder
{
    protected static string $file_path;
    protected static array $nullable_columns;
    protected static string $model;
    protected static string $table_name;
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
            SplFileObject::SKIP_EMPTY
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

        if (isset(static::$model)) {
            static::$model::upsert($values, static::$unique_by);
        } else if (isset(static::$table_name)) {
            DB::table(static::$table_name)->upsert($values, static::$unique_by);
        } else {
            assert(false);
        }
    }
}
