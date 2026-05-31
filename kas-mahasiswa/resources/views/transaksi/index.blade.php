@extends('layouts.app')

@section('title', 'Riwayat Transaksi Kas')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="m-0">Data Transaksi</h5>
        <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg"></i> Tambah Transaksi</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Anggota (Opsional)</th>
                        <th>Tipe</th>
                        <th>Jumlah</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d-m-Y') }}</td>
                        <td>{{ $transaksi->kategori->nama_kategori }}</td>
                        <td>{{ $transaksi->anggota ? $transaksi->anggota->nama : '-' }}</td>
                        <td>
                            @if($transaksi->tipe == 'pemasukan')
                                <span class="text-success"><i class="bi bi-arrow-down-circle"></i> Pemasukan</span>
                            @else
                                <span class="text-danger"><i class="bi bi-arrow-up-circle"></i> Pengeluaran</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $transaksi->keterangan }}</td>
                        <td>
                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center">Belum ada data transaksi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
