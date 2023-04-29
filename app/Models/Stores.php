<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StoreDetail;
use App\Models\BaseModel;

class Stores extends BaseModel
{
    public function store_detaiil () {
        return $this->hasOne(StoreDetail::class, 'store_id', 'id');
    }

    public static function storeSave($req)
    {
        $store = new Stores();
        $store->save();

        return $store;
    }


}
