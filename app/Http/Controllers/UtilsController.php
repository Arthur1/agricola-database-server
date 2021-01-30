<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtilsController extends Controller
{
    public function getVersion(Request $request) {
        return ['version' => config('app.version')];
    }
}
