<?php

namespace App\Service;

use App\Models\Teman;
use App\Models\SukaPostingan;
use App\Models\Postingan;
use Illuminate\Support\Facades\Auth;
use App\Repository\RepoPostinganInterface;

class PostinganService implements ServPostinganInterface
{
    protected $postinganRepo;
    public function __construct(RepoPostinganInterface $postinganRepo)
    {
        $this->postinganRepo = $postinganRepo;
    }
    public function addPostingan($newPostingan)
    {
        try {
            $idCurrentPengguna = Auth::user()->id;
            $newPostingan['pengguna_id'] = $idCurrentPengguna;
            $addedPostingan = $this->postinganRepo->storePostingan($newPostingan);
            return response()->json(['message' => 'berhasil membuat psotingan', 'data' => $addedPostingan], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function delPostingan($postingan)
    {
        try {
            $postingan->delete();
            return response()->json([
                'message' => 'berhasil menghapus postingan',
                'data' => $postingan
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function commentPostingan($newComment, $idPostingan)
    {
        try {
            $currentPengguna = Auth::user();
            $storedComment = $this->postinganRepo->storeComment($currentPengguna, $newComment, $idPostingan);
            return response()->json([
                'message' => 'berhasil menambahkan komentar',
                'data' => $storedComment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function delCommentPostingan($newComment, $idPostingan)
    {
        try {
            $currentPengguna = Auth::user();
            $storedComment = $this->postinganRepo->storeComment($currentPengguna, $newComment, $idPostingan);
            return response()->json([
                'message' => 'berhasil menambahkan komentar',
                'data' => $storedComment
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function delComment($idComment)
    {
        try {
            $deletedComment = $this->postinganRepo->delComment($idComment);
            return response()->json(['message' => 'berhasil menghapus komentar', 'data' => $deletedComment], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function likePostingan($idPostingan)
    {
        try {
            $currentPengguna = Auth::user();
            $isLiked = SukaPostingan::where('pengguna_id', $currentPengguna['id'])
                ->where('postingan_id', $idPostingan)
                ->first();
            if (!$isLiked) {
                $likedPostingan = $this->postinganRepo->likePostingan($currentPengguna, $idPostingan);
                return response()->json(['message' => 'berhasil menyukai postingan', 'data' => $likedPostingan], 200);
            } else {
                $unlikedPostingan = $this->postinganRepo->unlikedPostingan($currentPengguna, $idPostingan);
                return response()->json([
                    'message' => 'berhasil batal menyukai postingan',
                    'data' => $unlikedPostingan
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function showPostinganTeman()
    {
        try {
            $currentPengguna = Auth::user();
            $temanCurrentPengguna = Teman::where('pengguna_id', $currentPengguna->id)->get();
            $semuaPostinganTeman = [];

            foreach ($temanCurrentPengguna as $teman) {
                $postinganTeman = Postingan::where('pengguna_id', $teman->teman_id)->get();
                $semuaPostinganTeman = array_merge($semuaPostinganTeman, $postinganTeman->toArray());
            }
            return response()->json([
                'message' => 'Berhasil menampilkan postingan teman',
                'data' => $semuaPostinganTeman
            ], 200);

        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

}