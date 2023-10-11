<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Postingan extends Model
{
    use HasFactory, HasUuids, SoftDeletes;
    protected $table = 'postingan';
    protected $fillable = ['pengguna_id', 'filepath_postingan', 'deskripsi_postingan'];

    public function getIncrements()
    {
        return false;
    }
    public function getKeyType()
    {
        return 'string';
    }

    public function pengguna()
    {
        return $this->hasMany(Pengguna::class, 'pengguna_id', 'id');
    }
    public function postinganHaveComments()
    {
        return $this->belongsToMany(Pengguna::class, 'komentar', 'postingan_id', 'pengguna_id');
    }
    public function postinganHaveLikes()
    {
        return $this->belongsToMany(Pengguna::class, 'suka_postingan', 'postingan_id', 'pengguna_id');
    }
}