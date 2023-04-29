<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Helpers\ApiHelper;

class LoginController extends Controller
{
    public function index (Request $req)
    {
        if ($req->session()->exists('user_auth')) {
            $req->session()->forget('user_auth');
            // session()->flush();
            // Cache::flush();
        }

        if( strpos(url()->full(), '/logout') !== false ) {
            $message = [];
            $message['message'] = "Đăng xuất thành công";
            $message['message_title'] = "Thành công";
            return redirect('/login')->with('success', $message);
        }

        return view('auth.index');
    }

    public function loginSubmit(Request $req)
    {
        $input = $req->all();
        $message = [];
        $res = ApiHelper::postWithoutToken($input, '/api/v1/auth/login');
        if($res && $res->success) {
            $this->putUserInfo($res->user, $req);
            $message['message'] = $res->message;
            $message['message_title'] = $res->message_title;
            return redirect('/')->with('success', $message);
        }
        $message['message'] = $res->message;
        $message['message_title'] = $res->message_title;
        return redirect('/login')->with('error', $message);
    }
}
