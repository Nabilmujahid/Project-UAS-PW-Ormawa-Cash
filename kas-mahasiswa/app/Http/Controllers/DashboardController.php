<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\PengajuanRab;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Data Keuangan (Untuk Bendahara dan Ketua)
        $totalPemasukan = Transaksi::where('tipe', 'pemasukan')->sum('jumlah');
        $totalPengeluaran = Transaksi::where('tipe', 'pengeluaran')->sum('jumlah');
        $saldoKas = $totalPemasukan - $totalPengeluaran;
        $totalKas = $saldoKas;
        
        $pemasukanBulanIni = Transaksi::where('tipe', 'pemasukan')->whereMonth('tanggal', date('m'))->sum('jumlah');
        $pengeluaranBulanIni = Transaksi::where('tipe', 'pengeluaran')->whereMonth('tanggal', date('m'))->sum('jumlah');

        // Data RAB 
        $rabMasuk = PengajuanRab::count();
        $rabMenungguBendahara = PengajuanRab::where('status', 'Menunggu Verifikasi Bendahara')->count();
        $rabMenungguKetua = PengajuanRab::where('status', 'Menunggu Persetujuan Ketua')->count();
        $rabDisetujui = PengajuanRab::whereIn('status', ['Disetujui/Diterima', 'Dicairkan'])->count();
        $rabDitolak = PengajuanRab::whereIn('status', ['Ditolak Bendahara', 'Ditolak Ketua'])->count();

        // Data RAB Khusus Pengurus
        $myRabCount = 0;
        $myRabTerbaru = null;
        $myRabList = [];
        if ($user->role === 'pengurus') {
            $myRabCount = PengajuanRab::where('user_id', $user->id)->count();
            $myRabTerbaru = PengajuanRab::where('user_id', $user->id)->latest()->first();
            $myRabList = PengajuanRab::with('departemen')->where('user_id', $user->id)->latest()->take(5)->get();
        }

        // Data RAB terbaru untuk Bendahara
        $recentRabs = [];
        if ($user->role === 'bendahara') {
            $recentRabs = PengajuanRab::with(['user', 'departemen'])->where('status', 'Menunggu Verifikasi Bendahara')->latest()->take(5)->get();
        }

        // Data RAB terbaru untuk Ketua
        $ketuaRabs = [];
        if ($user->role === 'ketua') {
            $ketuaRabs = PengajuanRab::with(['user', 'departemen'])->where('status', 'Menunggu Persetujuan Ketua')->latest()->take(5)->get();
        }

        return view('dashboard', compact(
            'totalPemasukan',
            'totalPengeluaran',
            'saldoKas',
            'totalKas',
            'pemasukanBulanIni',
            'pengeluaranBulanIni',
            'rabMasuk',
            'rabMenungguBendahara',
            'rabMenungguKetua',
            'rabDisetujui',
            'rabDitolak',
            'myRabCount',
            'myRabTerbaru',
            'myRabList',
            'recentRabs',
            'ketuaRabs'
        ));
    }
}
