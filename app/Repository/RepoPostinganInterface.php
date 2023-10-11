<?php

namespace App\Repository;

interface RepoPostinganInterface
{
    public function storePostingan($newPostingan);
    public function storeComment($currentPengguna, $newComment, $idPostingan);
    public function delComment($idComment);
    public function likePostingan($currentPengguna, $idPostingan);
    public function unlikedPostingan($currenPengguna, $idPostingan);



}