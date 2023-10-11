<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use App\Models\Postingan;
use Illuminate\Http\Request;
use App\Service\ServPostinganInterface;
use App\Http\Requests\AddPostinganRequest;
use App\Http\Requests\commentPostinganRequest;

class PostinganController extends Controller
{
    protected $postinganService;
    public function __construct(ServPostinganInterface $postinganService)
    {
        $this->postinganService = $postinganService;
    }
    public function addPostingan(AddPostinganRequest $request)
    {
        return $this->postinganService->addPostingan($request->all());
    }
    public function delPostingan(Postingan $postingan)
    {
        return $this->postinganService->delPostingan($postingan);
    }
    public function commentPostingan(commentPostinganRequest $request, $idPostingan)
    {
        return $this->postinganService->commentPostingan($request->all(), $idPostingan);
    }
    public function delCommentPostingan($idComment)
    {
        return $this->postinganService->delComment($idComment);
    }
    public function likePostingan($idPostingan)
    {
        return $this->postinganService->likePostingan($idPostingan);
    }
    public function showPostinganTeman()
    {
        return $this->postinganService->showPostinganTeman();
    }
}