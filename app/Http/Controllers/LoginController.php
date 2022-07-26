<?php

namespace App\Http\Controllers;

use App\Models\SessionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $dataCheckLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($dataCheckLogin)) {
            $checkTokenExit = SessionUser::with('user')->where('user_id', auth()->id())->first();
            if (empty($checkTokenExit)) {
                $userSession = SessionUser::create([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+2 day')),
                    'user_id' => auth()->id(),
                ]);
                $userSession = SessionUser::with('user')->where('id', $userSession->id)->first();
            } else {
                $userSession = $checkTokenExit;
            }
            return response()->json([
                'code' => 200,
                'data' => $userSession,
            ], 200);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'email hoặc mật khẩu không đúng',
                'data' => [],
            ], 200);
        }
    }

    public function refreshToken(Request $request)
    {
        $token = $request->header('token');
        $checkTokenInvalid = SessionUser::where('token', $token)->first();
        // dd($checkTokenInvalid);
        if (!empty($checkTokenInvalid)) {
            if ($checkTokenInvalid->token_expried < date('Y-m-d H:i:s', time())) {
                $checkTokenInvalid->update([
                    'token' => Str::random(40),
                    'refresh_token' => Str::random(40),
                    'token_expried' => date('Y-m-d H:i:s', strtotime('+1 day')),
                    'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+2 day')),
                ]);
            }
        }
        $dataSession = SessionUser::with('user')->where('id', $checkTokenInvalid->id)->first();

        // $test = SessionUser::with('user')->first();
        return response()->json([
            'code' => 200,
            'message' => 'refresh Token success',
            'data' => $dataSession,
        ], 200);
    }
}
