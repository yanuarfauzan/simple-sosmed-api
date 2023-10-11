<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukaPostingan extends Model
{
    use HasFactory;
    protected $table = 'suka_postingan';
    protected $fillable = ['pengguna_id', 'postingan_id', 'created_at'];
    
}
