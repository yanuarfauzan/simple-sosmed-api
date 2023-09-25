<?php

namespace App\Repository;

interface RepoResetPwInterface
{
    public function storeTokenReset($data);
    public function updatePasswordPengguna($data);
}