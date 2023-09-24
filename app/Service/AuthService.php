<?php

namespace App\Service;

use App\Models\Pengguna;
use Illuminate\Support\Facades\Hash;
use App\Repository\RepoAuthInterface;

class AuthService implements ServAuthInterface
{
    protected $authRepo;
    public function __construct(RepoAuthInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }
    public function register($data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $newPengguna = $this->authRepo->store($data);
            return response()->json(['message' => 'Register berhasil', 'data' => $newPengguna], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function login($data)
    {
        try {
            $login = $data['login'];

            if (filter_var($login, FILTER_VALIDATE_EMAIL)) {
                $pengguna = Pengguna::where('email', $login)->first();
                return $this->checkPengguna($pengguna);
            } else {
                $pengguna = Pengguna::where('nama_pengguna', $login)->first();
                return $this->checkPengguna($pengguna);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()]);
        }
    }

    public function checkPengguna($data)
    {
        if ( $data === null) {
            return response()->json(['message' => 'email atau username belum terdaftar'], 400);
        }
        if (! $data && ! Hash::check($data['password'], $data['password']))
        {
            return response()->json(['message' => 'email, username atau password salah'], 400);
        }
        $tokenPengguna = $data->createToken('pengguna login')->plainTextToken;
        return response()->json(['message' => 'anda berhasil login', 'token login' => $tokenPengguna], 200); 
    }
}