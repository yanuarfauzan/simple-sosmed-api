<?php

namespace App\Repository;

use App\Models\Pengguna;

class AuthRepo implements RepoAuthInterface
{
    public function store($data)
    {
        try {
            $pengguna = Pengguna::create($data);
            return $pengguna;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    public function storeTokenVerif($data)
    {
        $data = [
            'token_verify' => $data
        ];
        try {
            $newToken = Pengguna::create($data);
            return $newToken;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function makeVerify($data){
        try {
            $pengguna = Pengguna::where('token_verify', $data['token_verify'])->first();
            $pengguna->update([
                'is_verify' => true,
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => $data['password']
            ]);
            return $pengguna;
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}