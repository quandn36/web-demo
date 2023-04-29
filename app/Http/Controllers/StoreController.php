<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ApiHelper;
use Illuminate\Pagination\LengthAwarePaginator;

class StoreController extends Controller
{
    public function index (Request $req)
    {
        return view('dashboard.stores.index');
    }

    public function listOfStore (Request $req)
    {
        $input = $req->all();
        $data = [];
        $pagination = [];
        $res = ApiHelper::getWithToken($this->getBearerToken($req), $this->uriGetStore . '?' . $this->buildQuery($input));

        if($res->success) {
            $data = $res->data;

            if($req->has('page')) {
                unset($input['page']);
            }
            $query = http_build_query($input);
            $pagination = new LengthAwarePaginator($data->data, $data->total, $data->per_page, $data->current_page, ['path' => $req->url() ."?". $query]);
        }
        return view('dashboard.stores.partial.list-partial', compact('data', 'pagination'));
    }

    public function storeSave (Request $req)
    {
        $input = $req->all();
        $res = ApiHelper::postWithToken($this->getBearerToken($req),$input, $this->uriGetStoreSave);

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

    public function storeDelete (Request $req)
    {
        $input = $req->all();
        $res = ApiHelper::getWithToken($this->getBearerToken($req), $this->uri_deleteStore . '?' . $this->buildQuery($input));

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
