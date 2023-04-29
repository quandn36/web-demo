<?php

namespace App\Models;

use App\Models\ProductDetail;
use App\Models\BaseModel;

class Products extends BaseModel
{
    public function product_detaiil () {
        return $this->hasOne(ProductDetail::class, 'product_id', 'id');
    }

    public static function productSave($req)
    {
        $product = new Products();
        $product->save();

        return $product;
    }
}
