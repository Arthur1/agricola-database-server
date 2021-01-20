<?php

namespace App\Models;

use App\DataTypes\SearchCardsOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Card extends Model
{
    use HasFactory;

    protected $table = 'cards';

    public $incrementing = false;

    public $timestamps = false;

    protected $hidden = [
        'product_id',
        'deck_id',
        'type_id',
        'rev2_category_icon_id',
        'special_color_id',
    ];

    protected $casts = [
        'ja_is_official' => 'boolean',
        'has_arrow' => 'boolean',
        'has_bonus' => 'boolean',
        'has_neg_bonus' => 'boolean',
        'has_pan_icon' => 'boolean',
        'has_bread_icon' => 'boolean',
    ];

    public function product(): Relation {
        return $this->belongsTo(Product::class);
    }

    public function deck(): Relation {
        return $this->belongsTo(Deck::class);
    }

    public function type(): Relation {
        return $this->belongsTo(CardType::class);
    }

    public function rev2_category_icon(): Relation {
        return $this->belongsTo(Rev2CategoryIcon::class);
    }

    public function special_color(): Relation {
        return $this->belongsTo(SpecialColor::class);
    }

    public static function findByRevisionAndLiteralId(int $revision_id, string $literal_id): self {
        return self::where('literal_id', $literal_id)
            ->ofRevision($revision_id)
            ->inDetail(true)
            ->first();
    }

    public static function getList(SearchCardsOptions $options): Collection {
        return self::inDetail(false)
            ->searchFilter($options)
            ->orderBy('id')
            ->get();
    }

    public static function getListByRevision(int $revision_id, SearchCardsOptions $options): Collection {
        return self::inDetail(false)
            ->ofRevision($revision_id)
            ->searchFilter($options)
            ->orderBy('id')
            ->get();
    }

    public function scopeInDetail(Builder $query, bool $is_in_detail): Builder {
        if ($is_in_detail) {
            $query->with(['product', 'deck', 'type', 'rev2_category_icon', 'special_color']);
        } else {
            $query->select(['id', 'literal_id', 'printed_id', 'type_id', 'name_ja', 'name_en', 'special_color_id'])
            ->with(['type', 'special_color']);
        }
        return $query;
    }

    public function scopeOfRevision(Builder $query, int $revision_id): Builder {
        return $query->whereHas('product', function (Builder $query) use ($revision_id) {
            $query->where('revision_id', $revision_id);
        });
    }

    public function scopeSearchFilter(Builder $query, SearchCardsOptions $options): Builder {
        if ($limit = $options->getLimit()) {
            $query->limit($limit);
        }
        if ($offset = $options->getOffset()) {
            $query->offset($offset);
        }
        if ($product_id = $options->getProductId()) {
            $query->where('product_id', $product_id);
        }
        if ($deck_id = $options->getDeckId()) {
            $query->where('deck_id', $deck_id);
        }
        if ($type_id = $options->getTypeId()) {
            $query->where('type_id', $type_id);
        }
        if ($name_ja = $options->getNameJa()) {
            $query->where('name_ja', 'like', "%{$name_ja}%");
        }
        if ($name_en = $options->getNameEn()) {
            $query->where('name_en', 'like', "%{$name_en}%");
        }
        if ($description_words = $options->getDescriptionWords()) {
            $query->where(function($query) use ($description_words) {
                foreach ($description_words as $word) {
                    $query->orWhere('description', 'like', "%{$word}%");
                }
            });
        }
        return $query;
    }
}
