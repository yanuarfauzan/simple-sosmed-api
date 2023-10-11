<?php

namespace App\Repository;

use App\Models\Komentar;
use App\Models\Postingan;

class PostinganRepo implements RepoPostinganInterface
{
    public function storePostingan($newPostingan)
    {
        return Postingan::create($newPostingan);
    }
    public function storeComment($currentPengguna, $newComment, $idPostingan)
    {
        $currenPostingan = Postingan::find($idPostingan);
        return $currenPostingan->postinganHaveComments()->attach($currentPengguna['id'], [
            'isi_komentar' => $newComment['isi_komentar'],
            'created_at' => now()
        ]);
    }
    public function delComment($idComment)
    {
        $comment = Komentar::find($idComment);
        return $comment->delete();
    }
    public function likePostingan($currentPengguna, $idPostingan)
    {
        $currentPostingan = Postingan::where('id', $idPostingan)->first();
        return $currentPostingan->postinganHaveLikes()->attach($currentPengguna['id']);
    }
    public function unlikedPostingan($currentPengguna, $idPostingan)
    {
        $currentPostingan = Postingan::where('id', $idPostingan)->first();
        return $currentPostingan->postinganHaveLikes()->detach($currentPengguna['id']);
    }
}