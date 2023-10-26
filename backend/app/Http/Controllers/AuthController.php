<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegistrationRequest;
use App\Http\Services\AuthService;

class AuthController extends Controller
{
    /**
     * @param LoginRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AuthException
     */
    public function login(LoginRequest $request, AuthService $service)
    {
        return $service->login($request->validated());
    }

    /**
     * @param RegistrationRequest $request
     * @param AuthService $service
     * @return \Illuminate\Http\JsonResponse
     */
    public function registration(RegistrationRequest $request, AuthService $service)
    {
        return $service->registration($request->validated());
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Successful logout.',
        ]);
    }
}
