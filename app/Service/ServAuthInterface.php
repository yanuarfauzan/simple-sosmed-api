<?php

namespace App\Service;

interface ServAuthInterface
{
    public function register($data);
    public function login($data);
    public function checkPengguna($data);
}