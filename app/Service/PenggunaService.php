<?php

namespace App\Service;

use App\Models\Teman;
use Illuminate\Support\Facades\Auth;
use App\Repository\RepoPenggunaInterface;

class PenggunaService implements ServPenggunaInterface
{
    protected $penggunaRepo;
    public function __construct(RepoPenggunaInterface $penggunaRepo)
    {
        $this->penggunaRepo = $penggunaRepo;
    }
    public function editProfile($newProfile)
    {
        try {
            $oldProfile = Auth::user();
            $updatedPengguna = $this->penggunaRepo->updateProfile($oldProfile, $newProfile);
            return response()->json(['message' => 'profile berhasil di update', 'data' => $updatedPengguna], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function addDelTeman($idTeman)
    {
        try {
            $idCurrentPengguna = Auth::user()->id;
            $isTeman = Teman::where('pengguna_id', $idCurrentPengguna)->where('teman_id', $idTeman)->first();
            if (!$isTeman) {
                $newTeman = $this->penggunaRepo->addTeman($idCurrentPengguna, $idTeman['idTeman']);
                return response()->json(['message' => 'berhasil menambahkan teman', 'data' => $newTeman], 200);
            } else {
                $deletedTeman = $this->penggunaRepo->deleteTeman($isTeman);
                return response()->json(['message' => 'Berhasil menghapus teman', 'data' => $deletedTeman], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function showTeman()
    {
        try {
            $idCurrentPengguna = Auth::user()->id;
            $showedTeman = $this->penggunaRepo->getTeman($idCurrentPengguna);
            return response()->json(['message' => 'berhasil menampilkan teman', 'data' => $showedTeman], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }


}