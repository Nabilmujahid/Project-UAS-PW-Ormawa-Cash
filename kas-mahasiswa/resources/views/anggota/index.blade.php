@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
<div class="card shadow">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="m-0">Daftar Anggota</h5>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg"></i> Tambah Anggota
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>Email Login</th>
                        <th>No HP</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($anggotas as $anggota)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $anggota->nim }}</td>
                        <td>{{ $anggota->nama }}</td>
                        <td>{{ $anggota->jabatan }}</td>
                        <td>{{ $anggota->email ?? '-' }}</td>
                        <td>{{ $anggota->no_hp }}</td>
                        <td>
                            <a href="{{ route('anggota.edit', $anggota->id) }}"
                                 class="btn btn-warning btn-sm table-action-btn">
                                 <i class="bi bi-pencil-square"></i>
                                Edit
                            </a>

                            <form action="{{ route('anggota.destroy', $anggota->id) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="btn btn-danger btn-sm table-action-btn">
                                    <i class="bi bi-trash"></i>
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Belum ada data anggota.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection