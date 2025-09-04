<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\UserService;
use Illuminate\Http\Request;
use DB;
use Auth;

class AuthController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function register(RegisterRequest $request)
    {
        try {
            return ResponseHelper::success($this->userService->handleRegister($request), 'berhasil register');
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function login(LoginRequest $request)
    {
        try {
            return ResponseHelper::success($this->userService->handleLogin($request), 'berhasil login');
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }

    public function logout()
    {
        try {
            if (!Auth::check()) return ResponseHelper::error('gagal logout');
            $user = Auth::user();
            $user->currentAccessToken()->delete();

            return ResponseHelper::success(null, 'berhasil logout');
        } catch (\Throwable $th) {
            return ResponseHelper::error(null, $th->getMessage());
        }
    }
}
