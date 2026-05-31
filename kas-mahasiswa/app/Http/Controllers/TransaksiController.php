<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Kategori;
use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with(['kategori', 'anggota'])
            ->latest('tanggal')
            ->get();

        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        $anggotas = Anggota::all();

        return view('transaksi.create', compact('kategoris', 'anggotas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'anggota_id' => 'nullable|exists:anggotas,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',

            // Validasi bukti transaksi
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Proses upload bukti transaksi
        if ($request->hasFile('bukti')) {
            $validated['bukti'] = $request->file('bukti')->store('bukti-transaksi', 'public');
        }

        Transaksi::create($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaksi $transaksi)
    {
        $kategoris = Kategori::all();
        $anggotas = Anggota::all();

        return view('transaksi.edit', compact('transaksi', 'kategoris', 'anggotas'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'kategori_id' => 'required|exists:kategoris,id',
            'anggota_id' => 'nullable|exists:anggotas,id',
            'tipe' => 'required|in:pemasukan,pengeluaran',
            'jumlah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',

            // Validasi bukti transaksi
            'bukti' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Kalau ada bukti baru diupload
        if ($request->hasFile('bukti')) {

            // Hapus bukti lama jika ada
            if ($transaksi->bukti && Storage::disk('public')->exists($transaksi->bukti)) {
                Storage::disk('public')->delete($transaksi->bukti);
            }

            // Simpan bukti baru
            $validated['bukti'] = $request->file('bukti')->store('bukti-transaksi', 'public');
        } else {
            // Kalau tidak upload bukti baru, jangan ubah bukti lama
            unset($validated['bukti']);
        }

        $transaksi->update($validated);

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        // Hapus file bukti jika ada
        if ($transaksi->bukti && Storage::disk('public')->exists($transaksi->bukti)) {
            Storage::disk('public')->delete($transaksi->bukti);
        }

        $transaksi->delete();

        return redirect()
            ->route('transaksi.index')
            ->with('success', 'Transaksi berhasil dihapus.');
    }
}