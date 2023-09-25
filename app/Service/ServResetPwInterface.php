<?php

namespace App\Service;

interface ServResetPwInterface
{
    public function sendEmailReset($data);
    public function updatePassword($data);
}