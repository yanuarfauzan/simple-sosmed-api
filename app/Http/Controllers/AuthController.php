<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Service\ServAuthInterface;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(ServAuthInterface $authService)
    {
        $this->authService = $authService;
    }
    public function register(RegisterRequest $request)
    {
        try {
            return $this->authService->register($request->all());
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->all());
    }
}
