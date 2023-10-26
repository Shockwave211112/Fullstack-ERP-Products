<?php

namespace App\Http\Services;

use App\Exceptions\AuthException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     * @throws AuthException
     */
    public function login(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            throw new AuthException(message: 'User not found.', status: '404');
        }

        if (!Hash::check($data['password'], $user->password)) {
            throw new AuthException(message: 'Email/login and password mismatch', status: '403');
        }

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
            'username' => $user->name,
        ]);
    }

    /**
     * @param array $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(array $data)
    {
        $user = User::create($data);

        $user->assignRole(User::USER);

        return response()->json([
            'token' => $user->createToken('auth')->plainTextToken,
        ]);
    }
}
