<?php

namespace App\Repository;

interface RepoAuthInterface
{
    public function store($data);
    public function storeTokenVerif($data);
    public function makeVerify($data);

}