<?php


namespace App\Repository;

use App\Models\Teman;
use App\Models\Postingan;

class PenggunaRepo implements RepoPenggunaInterface
{
    public function updateProfile($oldProfile, $newProfile)
    {
        return $newProfile;
    }
    public function addTeman($idCurrentPengguna, $idTeman)
    {
        return Teman::create([
            'pengguna_id' => $idCurrentPengguna,
            'teman_id' => $idTeman
        ]);
    }
    public function deleteTeman($isTeman)
    {
        return $isTeman->delete();
    }
    public function getTeman($idCurrentPengguna)
    {
        return Teman::where('pengguna_id', $idCurrentPengguna)->with('teman')->get();
    }
}