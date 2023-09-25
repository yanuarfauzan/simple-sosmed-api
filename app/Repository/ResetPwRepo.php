<?php

namespace App\Repository;

use App\Models\Pengguna;
use Illuminate\Support\Str;
use App\Models\ResetPassword;
use Illuminate\Support\Facades\Hash;

class ResetPwRepo implements RepoResetPwInterface
{
    public function storeTokenReset($data)
    {
        try {
            $new_token_reset = ResetPassword::create([
                'email' => $data['email'],
                'token' => $data['token_reset'],
            ]);
            return $new_token_reset;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function updatePasswordPengguna($data) 
    {
        try {
            $tokenPengguna = ResetPassword::where('token', $data['token_reset'])->first();
            $pengguna = Pengguna::where('email', $tokenPengguna['email'])->first();
            $pengguna->update([
                'password' => Hash::make($data['password']),
                'token_verify' => Str::random(64)
            ]);
            $tokenPengguna->update([
                'used_token' => true
            ]);
            return $pengguna;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}