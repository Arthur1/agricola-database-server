<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ag2CategoryIcon extends Model
{
    use HasFactory;

    protected $table = 'ag2_category_icons';

    public $incrementing = false;

    public $timestamps = false;
}
