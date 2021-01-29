<?php

namespace App\Http\Controllers;

use App\Http\Resources\DeckCollection;
use Illuminate\Http\Request;
use App\Models\Deck;

class DecksController extends Controller
{
    public function getList(Request $request) {
        return new DeckCollection(Deck::getList());
    }

    public function getListByRevision(Request $request, $revision_id) {
        return new DeckCollection(Deck::getListByRevision($revision_id));
    }
}
