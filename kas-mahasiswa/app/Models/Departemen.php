<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    protected $fillable = ['nama_departemen', 'deskripsi'];

    public function pengajuanRabs()
    {
        return $this->hasMany(PengajuanRab::class);
    }
}
