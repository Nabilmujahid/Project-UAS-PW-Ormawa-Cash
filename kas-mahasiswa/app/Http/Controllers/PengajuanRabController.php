<?php

namespace App\Http\Controllers;

use App\Models\PengajuanRab;
use App\Models\Departemen;
use App\Models\Transaksi;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanRabController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'bendahara') {
            $pengajuans = PengajuanRab::with(['user', 'departemen'])->orderBy('created_at', 'desc')->get();
        } elseif ($user->role === 'ketua') {
            $pengajuans = PengajuanRab::with(['user', 'departemen'])
                ->whereIn('status', ['Menunggu Persetujuan Ketua', 'Revisi Ketua', 'Ditolak Ketua', 'Disetujui/Diterima', 'Dicairkan'])
                ->orderBy('created_at', 'desc')->get();
        } else {
            $pengajuans = PengajuanRab::with('departemen')->where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        }

        return view('pengajuan_rab.index', compact('pengajuans'));
    }

    public function create()
    {
        if (Auth::user()->role !== 'pengurus') return abort(403);
        $departemens = Departemen::all();
        return view('pengajuan_rab.create', compact('departemens'));
    }

    public function store(Request $request)
    {
        if (Auth::user()->role !== 'pengurus') return abort(403);

        $request->validate([
            'departemen_id' => 'required|exists:departemens,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tujuan_kegiatan' => 'required|string',
            'rincian_kebutuhan' => 'required|string',
            'total_dana' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['status'] = 'Menunggu Verifikasi Bendahara';

        PengajuanRab::create($data);

        return redirect()->route('pengajuan-rab.index')->with('success', 'RAB berhasil diajukan.');
    }

    public function show($id)
    {
        $pengajuan = PengajuanRab::with(['user', 'departemen'])->findOrFail($id);
        return view('pengajuan_rab.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = PengajuanRab::findOrFail($id);
        if (Auth::id() !== $pengajuan->user_id) return abort(403);
        if (!in_array($pengajuan->status, ['Revisi Bendahara', 'Revisi Ketua'])) {
            return redirect()->route('pengajuan-rab.index')->with('error', 'Pengajuan ini tidak dapat diedit.');
        }

        $departemens = Departemen::all();
        return view('pengajuan_rab.edit', compact('pengajuan', 'departemens'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanRab::findOrFail($id);
        if (Auth::id() !== $pengajuan->user_id) return abort(403);

        $request->validate([
            'departemen_id' => 'required|exists:departemens,id',
            'nama_kegiatan' => 'required|string|max:255',
            'tanggal_kegiatan' => 'required|date',
            'tujuan_kegiatan' => 'required|string',
            'rincian_kebutuhan' => 'required|string',
            'total_dana' => 'required|numeric|min:0',
        ]);

        $data = $request->all();
        // Kembalikan status ke Menunggu Verifikasi Bendahara jika diedit setelah direvisi Bendahara
        if ($pengajuan->status === 'Revisi Bendahara') {
            $data['status'] = 'Menunggu Verifikasi Bendahara';
        } elseif ($pengajuan->status === 'Revisi Ketua') {
            $data['status'] = 'Menunggu Persetujuan Ketua';
        }

        $pengajuan->update($data);

        return redirect()->route('pengajuan-rab.index')->with('success', 'RAB berhasil diperbarui.');
    }

    public function verifikasi(Request $request, $id)
    {
        $pengajuan = PengajuanRab::findOrFail($id);
        
        $request->validate([
            'aksi' => 'required|in:terima,tolak,revisi',
            'catatan_bendahara' => 'nullable|string'
        ]);

        $pengajuan->catatan_bendahara = $request->catatan_bendahara;
        $pengajuan->tanggal_verifikasi_bendahara = now();

        if ($request->aksi === 'terima') {
            $pengajuan->status = 'Menunggu Persetujuan Ketua';
        } elseif ($request->aksi === 'revisi') {
            $pengajuan->status = 'Revisi Bendahara';
        } else {
            $pengajuan->status = 'Ditolak Bendahara';
        }

        $pengajuan->save();

        return redirect()->route('pengajuan-rab.index')->with('success', 'Berhasil melakukan verifikasi RAB.');
    }

    public function persetujuan(Request $request, $id)
    {
        $pengajuan = PengajuanRab::findOrFail($id);

        $request->validate([
            'aksi' => 'required|in:terima,tolak,revisi',
            'catatan_ketua' => 'nullable|string'
        ]);

        $pengajuan->catatan_ketua = $request->catatan_ketua;
        $pengajuan->tanggal_persetujuan_ketua = now();

        if ($request->aksi === 'terima') {
            $pengajuan->status = 'Disetujui/Diterima';
        } elseif ($request->aksi === 'revisi') {
            $pengajuan->status = 'Revisi Ketua';
        } else {
            $pengajuan->status = 'Ditolak Ketua';
        }

        $pengajuan->save();

        return redirect()->route('pengajuan-rab.index')->with('success', 'Berhasil memberikan persetujuan RAB.');
    }

    public function cairkan(Request $request, $id)
    {
        $pengajuan = PengajuanRab::findOrFail($id);

        if ($pengajuan->status !== 'Disetujui/Diterima') {
            return redirect()->back()->with('error', 'Status tidak valid untuk pencairan.');
        }

        $pengajuan->status = 'Dicairkan';
        $pengajuan->save();

        // Cari kategori 'Dana Kegiatan'
        $kategori = Kategori::where('nama_kategori', 'Dana Kegiatan')->first();

        // Catat sebagai transaksi pengeluaran
        Transaksi::create([
            'tanggal' => now(),
            'kategori_id' => $kategori ? $kategori->id : 4,
            'tipe' => 'pengeluaran',
            'jumlah' => $pengajuan->total_dana,
            'keterangan' => 'Pencairan RAB: ' . $pengajuan->nama_kegiatan,
        ]);

        return redirect()->route('pengajuan-rab.index')->with('success', 'Dana RAB berhasil dicairkan dan dicatat ke Transaksi.');
    }
}
