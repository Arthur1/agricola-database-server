<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialColor extends Model
{
    use HasFactory;

    protected $table = 'special_colors';

    public $incrementing = false;

    public $timestamps = false;
}
