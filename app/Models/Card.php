<?php

namespace App\Models;

use App\DataTypes\SearchCardsOptions;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

class Card extends Model
{
    use HasFactory;

    const LIST_DEFAULT_LIMIT = 30;

    protected $table = 'cards';

    public $incrementing = false;

    public $timestamps = false;

    protected $hidden = [
        'deck_id',
        'type_id',
        'ag2_category_icon_id',
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

    protected $with = [
        'products',
        'deck',
        'type',
        'ag2_category_icon',
        'special_color',
    ];

    public function products(): Relation {
        return $this->belongsToMany(Product::class);
    }

    public function deck(): Relation {
        return $this->belongsTo(Deck::class);
    }

    public function type(): Relation {
        return $this->belongsTo(CardType::class);
    }

    public function ag2_category_icon(): Relation {
        return $this->belongsTo(Ag2CategoryIcon::class);
    }

    public function special_color(): Relation {
        return $this->belongsTo(SpecialColor::class);
    }

    public function origin_cards(): Relation {
        return $this->belongsToMany(self::class, 'card_republished', 'card_id', 'origin_card_id');
    }

    public function republished_cards(): Relation {
        return $this->belongsToMany(self::class, 'card_republished', 'origin_card_id', 'card_id');
    }

    public static function findByRevisionAndLiteralId(int $revision_id, string $literal_id): self {
        return self::where('literal_id', $literal_id)
            ->ofRevision($revision_id)
            ->inDetail()
            ->firstOrFail();
    }

    public static function getList(SearchCardsOptions $options) {
        $query = self::inDetail()
            ->searchFilter($options)
            ->orderBy('id');
        if ($options->getPage()) {
            return $query->paginate($options->getLimit() ?: self::LIST_DEFAULT_LIMIT);
        } else {
            return $query->get();
        }
    }

    public static function getListByRevision(int $revision_id, SearchCardsOptions $options) {
        $query = self::inDetail()
            ->ofRevision($revision_id)
            ->searchFilter($options)
            ->orderBy('id');
        if ($options->getPage()) {
            return $query->paginate($options->getLimit() ?: self::LIST_DEFAULT_LIMIT);
        } else {
            return $query->get();
        }
    }

    public function scopeInDetail(Builder $query): Builder {
        $query->with(['origin_cards', 'republished_cards']);
        return $query;
    }

    public function scopeOfRevision(Builder $query, int $revision_id): Builder {
        return $query->where('revision_id', $revision_id);
    }

    public function scopeSearchFilter(Builder $query, SearchCardsOptions $options): Builder {
        if ($product_id = $options->getProductId()) {
            $query->whereHas('products', function (Builder $query) use ($product_id) {
                $query->where('products.id', $product_id);
            });
        }
        if ($deck_id = $options->getDeckId()) {
            $query->where('deck_id', $deck_id);
        }
        if ($type_id = $options->getTypeId()) {
            if ($type_id === -1) {
                $query->whereNotIn('type_id', [1, 2, 3]);
            } else {
                $query->where('type_id', $type_id);
            }
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
                    $query->where('description', 'like', "%{$word}%");
                }
            });
        }
        return $query;
    }
}
