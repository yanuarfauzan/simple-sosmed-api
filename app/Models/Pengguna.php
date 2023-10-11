<?php

namespace App\Models;

use App\Models\Postingan;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengguna extends Model
{
    use HasFactory, HasUuids, SoftDeletes, Notifiable, HasApiTokens, CanResetPassword;

    protected $table = 'pengguna';
    protected $fillable = [
        'username',
        'nama_depan',
        'nama_belakang',
        'email',
        'password',
        'profil_path',
        'alamat',
        'pekerjaan',
        'dilihat_berapa_kali',
        'token_verify',
        'is_verify',
        'deleted_at',
        'created_at',
        'updated_at'
    ];
    public function getIncerements()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
    public function postingan()
    {
        return $this->belongsTo(Postingan::class);
    }
    public function commentPostingan()
    {
        return $this->belongsToMany(Postingan::class, 'komentar', 'pengguna_id', 'postingan_id');
    }
    public function sukaPostingan()
    {
        return $this->belongsToMany(Postingan::class, 'suka_postingan', 'pengguna_id', 'postingan_id');
    }
}