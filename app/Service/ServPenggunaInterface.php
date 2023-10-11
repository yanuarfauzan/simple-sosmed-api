<?php

namespace App\Service;

interface ServPenggunaInterface
{
    public function editProfile($newProfile);
    public function addDelTeman($idTeman);
    public function showTeman();
}