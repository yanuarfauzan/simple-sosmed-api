<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Service\ServResetPwInterface;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;

class ResetPasswordController extends Controller
{
    protected $resetPwService;
    public function __construct(ServResetPwInterface $resetPwService)
    {
        $this->resetPwService = $resetPwService;
    }
    public function forgotPassword(ForgotPasswordRequest $request)
    {
        return $this->resetPwService->sendEmailReset($request->all());
    }
    public function resetPassword(ResetPasswordRequest $request, $token)
    {
        $request['token_reset'] = $token;
        return $this->resetPwService->updatePassword($request->all());
    }
}
