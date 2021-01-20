<?php

namespace App\Http\DataTypeGenerators;

use App\DataTypes\DataType;

interface DataTypeGenerator {
    public function get(): DataType;
}
