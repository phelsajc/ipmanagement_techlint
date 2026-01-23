<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = auth('api')->attempt($credentials)) {
            $this->logs([
                'user_id' => auth('api')->id(),
                'event' => 'login',
                'ip_address' => request()->ip(),
                'details' => ['status' => 'failed login']
            ]);
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $this->logs([
            'user_id' => auth('api')->id(),
            'event' => 'login',
            'ip_address' => request()->ip(),
            'details' => ['status' => 'success login']
        ]);

        return $this->respondWithToken($token);
    }

    public function logout()
    {
        auth('api')->logout();
        $this->logs([
            'user_id' => auth('api')->id(),
            'event' => 'logout',
            'ip_address' => request()->ip(),
            'details' => ['status' => 'Successfully logged out']
        ]);
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refreshtoken()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

    public function logs($arr)
    {
        AuditLog::create([
            'user_id' => $arr['user_id'],
            'event' => $arr['event'],
            'ip_address' => $arr['ip_address'],
            'details' => $arr['details'],
        ]);
    }
}
