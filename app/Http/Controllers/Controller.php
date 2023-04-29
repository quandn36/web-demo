<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

define('Apiv1', '/api/v1/auth');

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected $uriGetStore = Apiv1 . '/get-store';
    protected $uriGetProduct = Apiv1 . '/get-product';
    protected $uriGetStoreSave = Apiv1 . '/get-store/save';
    protected $uriGetProducts = Apiv1 . '/get-products';
    protected $uriGetUnits = Apiv1 . '/get-units';
    protected $uri_productSave = Apiv1 . '/product-save';
    protected $uri_getTotalData = Apiv1 . '/get-total-data';
    protected $uri_deleteStore = Apiv1 . '/delete-store';
    protected $uri_deleteProduct = Apiv1 . '/delete-product';

    public function putUserInfo($userInfo, Request $req)
    {
        $req->session()->put('user_auth', $userInfo);
    }

    public function buildQuery($iData)
    {
        return http_build_query($iData);
    }

    public function getBearerToken(Request $req)
    {
        if ($req->session()->exists('user_auth')) {
            return $req->session()->get('user_auth')->token;
        } else {
            return null;
        }
    }
}
