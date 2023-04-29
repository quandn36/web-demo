<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Stores;
use App\Models\ProductDetail;
use Exception;

class DashboardApi extends Controller
{
    public function getTotalData (Request $req)
    {
       $totalProduct = Products::count();
       $totalStore = Stores::count();

       return response()->json([
            'totalProduct' => $totalProduct,
            'totalStore' => $totalStore,
       ]);
    }

}
