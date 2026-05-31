<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal',
        'kategori_id',
        'anggota_id',
        'tipe',
        'jumlah',
        'keterangan',
        'bukti',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}