<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => "Vui lòng gửi đúng và đủ thông tin",
                'message_title' => "Thất bại",
            ], 400);
        }

        $getUser = User::where('email', $request->email)->whereNull('deleted_at')->first();
        if($getUser) {
            return response()->json([
                'success' => false,
                'message' => "Tài khoản đã tồn tại vui lòng đăng nhập",
                'message_title' => "Thất bại",
            ], 400);
        }

        $user = new User([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        $user->save();
        return response()->json([
            'success' => true,
            'message' => "Tạo tài khoản thành công",
            'message_title' => "Thành công",
        ], 201);
    }

    public function login(Request $req)
    {
        try {
            $input = $req->all();
            $validator = Validator::make($input, [
                'username' => 'required',
                'password' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => "Đăng nhập không thành công",
                    'message_title' => "Thất bại",
                ], 400);
            }
            $login = Auth::attempt(['username' => $input['username'], 'password' => $input['password']],true);
            if(!$login) {
                return response()->json([
                    'success' => false,
                    'message' => 'Đăng nhập thất bại',
                    'message_title' => 'Thất bại',
                ], 401);
            }
            $user = $req->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            if ($req->remember){
                $token->expires_at = Carbon::now()->addWeeks(1);
            }
            $token->save();
            $user->token = $tokenResult->accessToken;
            $user->expires_at = Carbon::parse($tokenResult->token->expires_at)->toDateTimeString();
            return response()->json([
                'success' => true,
                'message' => 'Đăng nhập thành công',
                'message_title' => 'Thành công',
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString(),
                'user' => $user,
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'success' => false,
                'message' => 'Đăng nhập thất bại',
                'message_title' => 'Thất bại',
            ], 400);
        }
    }

    public function logout(req $req)
    {
        $req->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

    public function user(Request $request)
    {
        return response()->json($request->user());
    }
}
