<?php

namespace App\Service;

interface ServAuthInterface
{
    public function registerVerif($data);
    public function login($data);
    public function checkPengguna($data);
    public function register($token);
}