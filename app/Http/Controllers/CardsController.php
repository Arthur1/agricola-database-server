<?php

namespace App\Http\Controllers;

use App\Http\DataTypeGenerators\SearchCardsOptionsGenerator;
use App\Http\Resources\CardCollection;
use App\Http\Resources\CardResource;
use Illuminate\Http\Request;
use App\Models\Card;

class CardsController extends Controller
{
    public function getById(Request $request, $id) {
        return new CardResource(Card::findOrFail($id));
    }

    public function getByRevisionAndLiteralId(Request $request, $revision_id, $literal_id) {
        return new CardResource(Card::findByRevisionAndLiteralId($revision_id, $literal_id));
    }

    public function getList(Request $request) {
        $options = (new SearchCardsOptionsGenerator($request))->get();
        return new CardCollection(Card::getList($options));
    }

    public function getListByRevision(Request $request, $revision_id) {
        $options = (new SearchCardsOptionsGenerator($request))->get();
        return new CardCollection(Card::getListByRevision($revision_id, $options));
    }
}
