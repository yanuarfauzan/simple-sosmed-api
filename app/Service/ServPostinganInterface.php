<?php

namespace App\Service;

interface ServPostinganInterface
{
    public function addPostingan($newPostingan);
    public function delPostingan($postingan);
    public function delComment($comment);
    public function likePostingan($idPostingan);
}