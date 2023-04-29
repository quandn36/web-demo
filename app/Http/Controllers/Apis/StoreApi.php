<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller as Controller;
use App\Models\ProductDetail;
use Illuminate\Http\Request;
use App\Models\Stores;
use App\Models\StoreDetail;
use Exception;

class StoreApi extends Controller
{
    public function ListStore (Request $req)
    {
        $data = StoreDetail::getListStore($req);

        return response()->json([
            'success' => true,
            'data' => $data
        ], 200);
    }

    public function storeSave (Request $req)
    {
        try {
            if($req->filled('store_id') && $req->store_id) {
                $store = Stores::find($req->store_id);
                $oldStoreDetail = StoreDetail::where('store_id', $req->store_id)->whereNull('deleted_at')->first();
                $storeDetail = StoreDetail::storeDetailSave($req, $store->id);
                $oldStoreDetail->delete();
                return response()->json([
                    'success' => true,
                    'message' => 'Cập nhật thành công',
                    'message_title' => 'Thành công',
                    'store' => $store,
                    'storeDetail' => $storeDetail,
                ], 200);
            }else{
                $store = Stores::storeSave($req);
                $storeDetail = StoreDetail::storeDetailSave($req, $store->id);
                return response()->json([
                    'success' => true,
                    'message' => 'Tạo mới thành công',
                    'message_title' => 'Thành công',
                    'store' => $store,
                    'storeDetail' => $storeDetail,
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

    public static function deleteStore(Request $req)
    {
        if( !Stores::where('id', $req->store_id)->whereNull('deleted_at')->first() ) {
            return response()->json([
                'success' => false,
                'message' => 'Thông tin cửa hàng không tồn tại, vui lòng kiểm tra lại',
                'message_title' => 'Thất bại',
            ], 400);
        }
        $checkProdInStore = ProductDetail::where('store_id', $req->store_id)->whereNull('deleted_at')->count();
        if($checkProdInStore) {
            return response()->json([
                'success' => false,
                'message' => 'Không thể xoá cửa hàng, vui lòng bỏ hết sản phẩm',
                'message_title' => 'Thất bại',
            ], 400);
        }
        $oldStore = Stores::where('id', $req->store_id)->whereNull('deleted_at')->first()->delete();
        $oldStore = StoreDetail::where('store_id', $req->store_id)->whereNull('deleted_at')->first()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Xoá cửa hàng thành công',
            'message_title' => 'Thất bại',
        ], 200);
    }
}
