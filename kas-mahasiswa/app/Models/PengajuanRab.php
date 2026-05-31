<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanRab extends Model
{
    protected $fillable = [
        'user_id',
        'departemen_id',
        'nama_kegiatan',
        'tanggal_kegiatan',
        'tujuan_kegiatan',
        'rincian_kebutuhan',
        'total_dana',
        'status',
        'catatan_bendahara',
        'catatan_ketua',
        'tanggal_verifikasi_bendahara',
        'tanggal_persetujuan_ketua'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function departemen()
    {
        return $this->belongsTo(Departemen::class);
    }
}
