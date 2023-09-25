<?php

namespace App\Models;

use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

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
}
