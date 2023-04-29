<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductDetail;
use Exception;

class ProductApi extends Controller
{
    public function ListProducts (Request $req)
    {
        $data = ProductDetail::getProducts($req);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function productSave (Request $req)
    {
        try {
            if($req->filled('product_id') && $req->product_id) {
                $product = Products::find($req->product_id);
                $oldProductDetail = ProductDetail::where('product_id', $req->product_id)->whereNull('deleted_at')->first();
                $productDetail = ProductDetail::productDetailSave($req, $product->id);
                $oldProductDetail->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'message_title' => 'Thành công',
                    'product' => $product,
                    'productDetail' => $productDetail,
                ], 200);
            }else{
                $product = Products::productSave($req);
                $productDetail = ProductDetail::productDetailSave($req, $product->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Tạo mới thành công',
                    'message_title' => 'Thành công',
                    'product' => $product,
                    'productDetail' => $productDetail,
                ], 200);
            }
        } catch (Exception $ex) {
            return response()->json([
                'success' => true,
                'message' => 'Lưu/Cập nhật thất bại',
                'message_title' => 'Thất bại',
            ], 400);
        }
    }

    public static function deleteProduct(Request $req)
    {
        if(!Products::where('id', $req->product_id)->whereNull('deleted_at')->first()) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin sản phẩm không tồn tại, vui lòng kiểm tra lại',
                'message_title' => 'Thất bại',
            ], 400);
        }

        $oldStore = Products::where('id', $req->product_id)->whereNull('deleted_at')->first()->delete();
        $oldStore = ProductDetail::where('product_id', $req->product_id)->whereNull('deleted_at')->first()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoá sản phẩm thành công',
            'message_title' => 'Thất bại',
        ], 200);
    }
}
