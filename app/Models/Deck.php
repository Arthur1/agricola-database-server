<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deck extends Model
{
    use HasFactory;

    protected $table = 'decks';

    public $incrementing = false;

    public $timestamps = false;

    public static function getList() {
        return self::select()->orderBy('id')->get();
    }

    public static function getListByRevision(int $revision_id) {
        return self::ofRevision($revision_id)->orderBy('id')->get();
    }

    public function scopeOfRevision(Builder $query, int $revision_id): Builder {
        return $query->where('revision_id', $revision_id);
    }
}
