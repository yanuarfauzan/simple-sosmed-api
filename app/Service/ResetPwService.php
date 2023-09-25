<?php

namespace App\Service;

use Illuminate\Support\Str;
use App\Jobs\DispatchSendEmailResetPw;
use App\Models\resetPassword;
use App\Repository\RepoResetPwInterface;

class ResetPwService implements ServResetPwInterface
{
    protected $resetPwRepo;
    public function __construct(RepoResetPwInterface $resetPwRepo)
    {
        $this->resetPwRepo = $resetPwRepo;
    }
    public function sendEmailReset($data)
    {
        try {
            $data['token_reset'] = Str::random(64);
            DispatchSendEmailResetPw::dispatch($data);
            $this->resetPwRepo->storeTokenReset($data);
            return response()->json(['message' => 'email reset password telah terkirim', 'token reset' => $data['token_reset']], 200);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function updatePassword($data)
    {
        try {
            $tokenPengguna = ResetPassword::where('token', $data['token_reset'])->first();
            if ($tokenPengguna) {
                if (!$tokenPengguna['used_token'] == true) {
                    $newPassword = $this->resetPwRepo->updatePasswordPengguna($data);
                    return response()->json(['message' => 'password berhasil diubah', 'password' => $newPassword], 200);
                } else {
                    return response()->json(['message' => 'token kadaluarsa']);
                }
            } else {
                return response()->json(['message' => 'token tidak benar']);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}