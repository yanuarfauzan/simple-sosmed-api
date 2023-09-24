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
}