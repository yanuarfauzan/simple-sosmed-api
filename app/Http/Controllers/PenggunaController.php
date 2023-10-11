<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use App\Service\ServPenggunaInterface;
use App\Http\Requests\AddDelTemanRequest;
use App\Http\Requests\EditProfileRequest;

class PenggunaController extends Controller
{
    protected $penggunaService;
    public function __construct(ServPenggunaInterface $penggunaService)
    {
        $this->penggunaService = $penggunaService;
    }
    public function editProfile(EditProfileRequest $request)
    {
        return $this->penggunaService->editProfile($request->all());
    }
    public function addTeman(AddDelTemanRequest $request)
    {
        return $this->penggunaService->addDelTeman($request->all());
    }
    public function showTeman()
    {
        return $this->penggunaService->showTeman();
    }
}