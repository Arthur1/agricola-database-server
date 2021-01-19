<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rev2CategoryIcon extends Model
{
    use HasFactory;

    protected $table = 'rev2_category_icons';

    public $incrementing = false;

    public $timestamps = false;
}
