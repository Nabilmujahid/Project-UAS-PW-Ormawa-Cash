@extends('layouts.app')

@section('title', 'Daftar Pengajuan RAB')

@section('content')
<div class="card shadow-sm border-0" style="border-radius: 15px;">
    <div class="card-header bg-white border-0 py-3 d-flex justify-content-between align-items-center">
        <h5 class="mb-0 fw-bold">Data Pengajuan RAB</h5>
        @if(Auth::user()->role === 'pengurus')
            <a href="{{ route('pengajuan-rab.create') }}" class="btn btn-danger rounded-pill shadow-sm"><i class="bi bi-plus-lg me-1"></i> Ajukan RAB</a>
        @endif
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No</th>
                        <th>Kegiatan</th>
                        <th>Departemen</th>
                        <th>Tgl Kegiatan</th>
                        <th>Total Dana</th>
                        <th>Status</th>
                        <th class="text-center pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuans as $key => $rab)
                    <tr>
                        <td class="ps-4">{{ $key + 1 }}</td>
                        <td class="fw-semibold text-dark">{{ $rab->nama_kegiatan }}</td>
                        <td>{{ $rab->departemen->nama_departemen ?? '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($rab->tanggal_kegiatan)->format('d M Y') }}</td>
                        <td>Rp {{ number_format($rab->total_dana, 0, ',', '.') }}</td>
                        <td>
                            @php
                                $badgeClass = 'bg-secondary';
                                if(str_contains($rab->status, 'Menunggu')) $badgeClass = 'bg-warning text-dark';
                                elseif(str_contains($rab->status, 'Revisi')) $badgeClass = 'bg-info text-dark';
                                elseif(str_contains($rab->status, 'Ditolak')) $badgeClass = 'bg-danger';
                                elseif(str_contains($rab->status, 'Disetujui') || str_contains($rab->status, 'Dicairkan')) $badgeClass = 'bg-success';
                            @endphp
                            <span class="badge {{ $badgeClass }} rounded-pill px-3">{{ $rab->status }}</span>
                        </td>
                        <td class="text-center pe-4">
                            <a href="{{ route('pengajuan-rab.show', $rab->id) }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3"><i class="bi bi-eye"></i> Detail</a>
                            @if(Auth::user()->role === 'pengurus' && in_array($rab->status, ['Revisi Bendahara', 'Revisi Ketua']))
                                <a href="{{ route('pengajuan-rab.edit', $rab->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 mt-1"><i class="bi bi-pencil"></i> Revisi</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">Belum ada data pengajuan RAB.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
