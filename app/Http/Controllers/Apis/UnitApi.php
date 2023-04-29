<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Units;
use Exception;

class UnitApi extends Controller
{
    public function listOfUnit (Request $req)
    {
        $data = Units::select('id', 'name')->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }
}
