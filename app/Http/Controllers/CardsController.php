<?php

namespace App\Http\Controllers;

use App\Http\DataTypeGenerators\SearchCardsOptionsGenerator;
use Illuminate\Http\Request;
use App\Models\Card;

class CardsController extends Controller
{
    public function getById(Request $request, $id) {
        $card = Card::findOrFail($id);
        return $card;
    }

    public function getByRevisionAndLiteralId(Request $request, $revision_id, $literal_id) {
        $card = Card::findByRevisionAndLiteralId($revision_id, $literal_id);
        return $card;
    }

    public function getList(Request $request) {
        $options = (new SearchCardsOptionsGenerator($request))->get();
        $cards = Card::getList($options);
        return $cards;
    }

    public function getListByRevision(Request $request, $revision_id) {
        $options = (new SearchCardsOptionsGenerator($request))->get();
        $cards = Card::getListByRevision($revision_id, $options);
        return $cards;
    }
}
