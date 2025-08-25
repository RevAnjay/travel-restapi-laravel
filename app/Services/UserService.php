<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Auth;
use Hash;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    public function handleRegister(RegisterRequest $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return (object) [
            'user' => new UserResource($user),
            'token' => $user->createToken('auth-token')->plainTextToken,
        ];
    }

    public function handleLogin(LoginRequest $request)
    {
        $validated = $request->validated();

        if (!Auth::attempt($validated)) return ResponseHelper::error(null, 'gagal untuk login', Response::HTTP_UNAUTHORIZED);
        $user = Auth::user();

        return (object) [
            'user' => new UserResource($user),
            'token' => $user->createToken('auth-token')->plainTextToken,
        ];
    }
}
