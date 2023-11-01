<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'barang';

    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function pinjam(){
        return $this->hasMany(DetailPeminjaman::class);
    }


}
