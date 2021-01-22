<?php

namespace App\Http\DataTypeGenerators;

use App\DataTypes\SearchCardsOptions;
use Illuminate\Http\Request;

class SearchCardsOptionsGenerator implements DataTypeGenerator {
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function get(): SearchCardsOptions {
        if ($name_ja = $this->request->query('name_ja')) {
            self::normalizeSearchText($name_ja);
        }

        if ($name_en = $this->request->query('name_en')) {
            self::normalizeSearchText($name_en);
        }

        $description_words = null;
        if ($description_query = $this->request->query('description_query')) {
            $description_query = self::normalizeSearchText($description_query);
            $description_words = explode(' ', $description_query);
            $description_words = array_filter($description_words, fn($w) => $w);
        }

        $options = new SearchCardsOptions(
            $this->request->query('limit'),
            $this->request->query('page'),
            $this->request->query('product_id'),
            $this->request->query('deck_id'),
            $this->request->query('type_id'),
            $name_ja,
            $name_en,
            $description_words
        );
        return $options;
    }

    private static function normalizeSearchText(string $text) {
        $text = mb_convert_kana($text, 's');
        $text = trim($text);
        $text = str_replace(['%', '_'], ['[%]', '[_]'], $text);
        return $text;
    }
}
