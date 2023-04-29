<?php

namespace App\Http\Controllers;

use App\Helpers\ApiHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $req)
    {
        $totalProduct = 123;
        $totalStore = 456;
        return view('dashboard.index', compact('totalProduct', 'totalStore'));
    }

    public function totalData (Request $req)
    {
        $res = ApiHelper::getWithToken($this->getBearerToken($req), $this->uri_getTotalData . '?' . $this->buildQuery($req));
        if(isset($res)) {
            return response()->json([
                'success' => true,
                'totalProduct' => $res->totalProduct,
                'totalStore' => $res->totalStore,
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'Lấy dữ liệu thất baij',
            'message_title' => 'Thất bại',
        ]);
    }
}
