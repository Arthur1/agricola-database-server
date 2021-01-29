<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function getList(Request $request) {
        return new ProductCollection(Product::getList());
    }

    public function getListByRevision(Request $request, $revision_id) {
        return new ProductCollection(Product::getListByRevision($revision_id));
    }
}
