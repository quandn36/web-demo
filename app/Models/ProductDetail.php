<?php

namespace App\Models;

use App\Models\Products;
use App\Models\BaseModel;
use App\Models\Units;
use App\Models\StoreDetail;

class ProductDetail extends BaseModel
{

    protected $table = 'product_detail';

    public function product () {
        return $this->hasOne(Products::class, 'id', 'product_id');
    }

    public function unit () {
        return $this->hasOne(Units::class, 'id', 'unit_id');
    }

    public function store_detail () {
        return $this->hasOne(StoreDetail::class, 'store_id', 'store_id');
    }

    public static function getProducts($req, $paginate = 10)
    {
        $data = ProductDetail::with(['product' => function($sqlProduct) {
            $sqlProduct->select('*');
        }])
        ->with(['unit' => function($sqlUnit) {
            $sqlUnit->select('*');
        }])
        ->with(['store_detail' => function($sqlStore) {
            $sqlStore->select('*');
        }]);

        if($req->filled('name') && $req->name) {
            $data->where('name', 'like', '%'.$req->name.'%');
        }
        if($req->filled('unit_id') && $req->unit_id) {
            $data->where('unit_id', $req->unit_id);
        }
        if($req->filled('store_id') && $req->store_id) {
            $data->where('store_id', $req->store_id);
        }
        $result = $data->orderBy('updated_at', 'desc')->paginate($paginate);

        for( $idx = 0; $idx < count($result); $idx++ ) {
            if(isset($result[$idx]->unit->name) && $result[$idx]->unit->name) {
                $result[$idx]->unit_name = $result[$idx]->unit->name;
            }
        }

        return $result;
    }

    public static function productDetailSave($req, $productId)
    {
        $productDetail = new ProductDetail();
        $productDetail->product_id = $productId;

        if($req->filled('name') && $req->name) {
            $productDetail->name = $req->name;
        }

        if($req->filled('unit_id') && $req->unit_id) {
            $productDetail->unit_id = $req->unit_id;
        }

        if($req->filled('store_id') && $req->store_id) {
            $productDetail->store_id = $req->store_id;
        }

        if($req->filled('description') && $req->description) {
            $productDetail->description = $req->description;
        }

        $productDetail->save();

        return $productDetail;
    }
}
