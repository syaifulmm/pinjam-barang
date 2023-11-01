<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Peminjaman extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'peminjaman';

    public function detail(){
        return $this->hasMany(DetailPeminjaman::class , 'peminjaman_id');
    }

}
