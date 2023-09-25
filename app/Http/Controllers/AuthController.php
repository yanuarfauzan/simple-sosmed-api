<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Service\ServAuthInterface;
use App\Http\Requests\RegisterVerifRequest;
use GuzzleHttp\Client;
class AuthController extends Controller
{
    protected $authService;
    public function __construct(ServAuthInterface $authService)
    {
        $this->authService = $authService;
    }
    public function registerVerif(RegisterVerifRequest $request)
    {
        return $this->authService->registerVerif($request->all());
    }
    public function login(LoginRequest $request)
    {
        return $this->authService->login($request->all());
    }
    public function register($token)
    {
        return $this->authService->register($token);
    }
}
