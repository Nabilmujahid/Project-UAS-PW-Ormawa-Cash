@extends('layouts.public')

@section('title', 'Informasi Kas')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Informasi <span class="text-red-primary">Kas Organisasi</span></h2>
        <p class="text-muted">Ringkasan kondisi keuangan himpunan saat ini secara transparan.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-8 mx-auto">
            <div class="glass-card p-4">
                <canvas id="kasChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-10 mx-auto">
            <h4 class="fw-bold mb-4 border-bottom pb-2">Transaksi Terbaru</h4>
            <div class="table-responsive glass-card p-3">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Jenis</th>
                            <th class="text-end">Nominal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $transaksi)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($transaksi->tanggal)->format('d M Y') }}</td>
                            <td>{{ $transaksi->kategori->nama_kategori ?? '-' }}</td>
                            <td>
                                @if($transaksi->tipe == 'pemasukan')
                                    <span class="badge bg-success rounded-pill px-3">Pemasukan</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3">Pengeluaran</span>
                                @endif
                            </td>
                            <td class="text-end fw-semibold">
                                Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada data transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-center mt-4">
                <p class="text-muted small"><i class="bi bi-info-circle me-1"></i> Data di atas hanya menampilkan 10 transaksi terakhir demi menjaga privasi dan keamanan data.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Data for chart (in a real app, this could be grouped by month)
        // For simplicity, we just show Pemasukan vs Pengeluaran total
        
        let pemasukan = {{ \App\Models\Transaksi::where('tipe', 'pemasukan')->sum('jumlah') }};
        let pengeluaran = {{ \App\Models\Transaksi::where('tipe', 'pengeluaran')->sum('jumlah') }};

        const ctx = document.getElementById('kasChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Total Pemasukan', 'Total Pengeluaran'],
                datasets: [{
                    data: [pemasukan, pengeluaran],
                    backgroundColor: [
                        '#10b981', // Emerald 500 for Pemasukan
                        '#e11d48'  // Rose 600 for Pengeluaran
                    ],
                    borderWidth: 0,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: 'Inter',
                                size: 14
                            }
                        }
                    },
                    title: {
                        display: true,
                        text: 'Rasio Pemasukan vs Pengeluaran',
                        font: {
                            family: 'Inter',
                            size: 16,
                            weight: 'bold'
                        }
                    }
                },
                cutout: '70%'
            }
        });
    });
</script>
@endpush
