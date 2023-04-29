<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function index (Request $req)
    {
        $input = $req->all();
        $input['get_all_store'] = true;
        $units = [];
        $stores = [];
        $resUnits = ApiHelper::getWithToken($this->getBearerToken($req), $this->uriGetUnits . '?' . $this->buildQuery($input));
        if($resUnits->success == true) {
            $units = $resUnits->data;
        }
        $resStores = ApiHelper::getWithToken($this->getBearerToken($req), $this->uriGetStore . '?' . $this->buildQuery($input));
        if($resStores->success == true) {
            $stores = $resStores->data;
        }

        return view('dashboard.products.index', compact('units', 'stores'));
    }

    public function listOfProduct (Request $req)
    {
        $input = $req->all();
        $data = [];
        $pagination = [];
        // dd($this->getBearerToken($req), $this->uriGetProducts . '?' . $this->buildQuery($input));
        $res = ApiHelper::getWithToken($this->getBearerToken($req), $this->uriGetProducts . '?' . $this->buildQuery($input));
        if($res->success) {
            $data = $res->data;

            if($req->has('page')) {
                unset($input['page']);
            }
            $query = http_build_query($input);
            $pagination = new LengthAwarePaginator($data->data, $data->total, $data->per_page, $data->current_page, ['path' => $req->url() ."?". $query]);
        }
        return view('dashboard.products.partial.list-partial', compact('data', 'pagination'));
    }

    public function productSave (Request $req)
    {
        $input = $req->all();
        $res = ApiHelper::postWithToken($this->getBearerToken($req), $input, $this->uri_productSave);

        if($res->success) {
            return response()->json([
                'success' => true,
                'message' => $res->message,
                'message_title' => $res->message_title,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => $res->message,
            'message_title' => $res->message_title,
        ], 400);
    }

    public function productDelete (Request $req)
    {
        $input = $req->all();
        $res = ApiHelper::getWithToken($this->getBearerToken($req), $this->uri_deleteProduct . '?' . $this->buildQuery($input));

        if($res->success) {
            return response()->json([
                'success' => true,
                'message' => $res->message,
                'message_title' => $res->message_title,
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => $res->message,
            'message_title' => $res->message_title,
        ], 200);
    }

}
