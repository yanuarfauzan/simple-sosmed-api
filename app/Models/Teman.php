<?php

namespace App\Models;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Teman extends Model
{
    use HasFactory;
    protected $table = 'teman';
    protected $fillable = ['pengguna_id', 'teman_id'];


    public function pengguna()
    {
        return $this->belongsTo(Pengguna::class, 'pengguna_id', 'id');
    }
    public function teman()
    {
        return $this->belongsTo(Pengguna::class, 'teman_id', 'id');
    }
}