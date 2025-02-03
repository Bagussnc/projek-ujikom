@extends('layout.su')

@section('content')
<main class="flex-1 p-6 bg-gray-100">
    <!-- Dashboard Content -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
        <!-- Total Barang -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 shadow-xl rounded-lg w-full flex flex-col items-center text-white">
            <h3 class="text-2xl font-semibold mb-4">Jumlah Barang</h3>
            <p class="text-4xl font-bold">{{ $jumlahBarang }}</p>
        </div>

        <!-- Total Peminjaman -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 p-6 shadow-xl rounded-lg w-full flex flex-col items-center text-white">
            <h3 class="text-2xl font-semibold mb-4">Jumlah Peminjaman</h3>
            <p class="text-4xl font-bold">{{ $jumlahPeminjaman }}</p>
        </div>
    </div>

    <!-- Grafik Peminjaman -->
    <div class="bg-white p-8 shadow-xl rounded-lg mt-8">
        <div class="flex justify-between items-center mb-6">
            <h3 class="text-2xl font-semibold text-gray-800">Grafik Peminjaman</h3>
        </div>
        <div class="relative h-80">
            <canvas id="loanChart"></canvas>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('loanChart').getContext('2d');
    const dataGrafik = @json($dataGrafik); // Data grafik dari controller

    const loanChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September',
                'Oktober', 'November', 'Desember'
            ],
            datasets: [{
                label: 'Jumlah Peminjaman',
                data: dataGrafik, // Gunakan data dari database
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 3,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointRadius: 5,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        font: {
                            size: 14
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        color: '#4B5563',
                        font: {
                            size: 12
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#4B5563',
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endpush