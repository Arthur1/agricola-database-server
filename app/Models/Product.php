<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'ja_is_official' => 'boolean',
    ];
}
