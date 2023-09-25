<?php

namespace App\Service;

use App\Models\Pengguna;
use Illuminate\Support\Str;
use App\Jobs\DispatchSendEmailVerif;
use Illuminate\Support\Facades\Hash;
use App\Repository\RepoAuthInterface;
use Illuminate\Support\Facades\Session;

class AuthService implements ServAuthInterface
{
    protected $authRepo;
    public function __construct(RepoAuthInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function registerVerif($data)
    {
        try {
            $data['password'] = Hash::make($data['password']);
            $data['token_verify'] = Str::random(64);
            Session::put('data_registrasi_pengguna', $data);
            try {
                $this->authRepo->storeTokenVerif($data['token_verify']);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 400);
            }
            try {
                DispatchSendEmailVerif::dispatch($data);
                return response()->json(['message' => 'Email verifikasi berhasil terkirim', 'token' => $data['token_verify']], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => $e->getMessage()], 400); 
            }
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
                if ($pengguna['is_verify'] == true){
                    return $this->checkPengguna($pengguna);
                } else {
                    return response()->json(['message' => 'email berlum terverifikasi'], 400);
                }
            } else {
                $pengguna = Pengguna::where('username', $login)->first();
                if ($pengguna['is_verify'] == true){
                    return $this->checkPengguna($pengguna);
                } else {
                    return response()->json(['message' => 'email berlum terverifikasi'], 400);
                }
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

    public function register($token)
    {
        try {
            $currentPengguna = Session::get('data_registrasi_pengguna');
            // dd($currentPengguna);
            if ($token == $currentPengguna['token_verify']){
                $verifiedPengguna = $this->authRepo->makeVerify($currentPengguna);
                return response()->json(['message' => 'email berhasil terverifikasi', 'data' => $verifiedPengguna], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}