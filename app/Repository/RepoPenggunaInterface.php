<?php

namespace App\Repository;

interface RepoPenggunaInterface
{
    public function updateProfile($oldProfile, $newProfile);
    public function addTeman($idCurrentPengguna, $idTeman);
    public function deleteTeman($isTeman);
    public function getTeman($idCurrentPengguna);
}