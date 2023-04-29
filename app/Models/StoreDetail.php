<?php

namespace App\Models;

use App\Models\Stores;
use App\Models\BaseModel;

class StoreDetail extends BaseModel
{
    protected $table = 'store_detail';

    public function store () {
        return $this->hasOne(Stores::class, 'id', 'store_id');
    }

    public static function getListStore($req, $paginate = 10)
    {
        $data = StoreDetail::with(['store' => function($sqlStore) {
            $sqlStore->select('*');
        }]);

        if($req->filled('name') && $req->name) {
            $data->where('name', 'like', '%'.$req->name.'%');
        }
        if($req->filled('address') && $req->address) {
            $data->where('address', 'like', '%'.$req->address.'%');
        }
        if($req->filled('phone') && $req->phone) {
            $data->where('phone', 'like', '%'.$req->phone.'%');
        }

        if($req->missing('get_all_store')) {
            $result = $data->orderBy('updated_at', 'desc')->paginate($paginate);
        }else{
            $result = $data->get();
        }


        return $result;
    }

    public static function storeDetailSave($req, $storeId)
    {
        $storeDetail = new StoreDetail();
        $storeDetail->store_id = $storeId;

        if($req->filled('name') && $req->name) {
            $storeDetail->name = $req->name;
        }

        if($req->filled('address') && $req->address) {
            $storeDetail->address = $req->address;
        }

        if($req->filled('phone') && $req->phone) {
            $storeDetail->phone = $req->phone;
        }

        if($req->filled('description') && $req->description) {
            $storeDetail->description = $req->description;
        }

        $storeDetail->save();

        return $storeDetail;
    }
}
