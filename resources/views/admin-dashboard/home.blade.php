@extends('layouts.app_custom')
@section('title', 'Dashboard')
@section('title-head', 'Admin - Dashboard')
@section('styles')
<style>
    /* .card-statistic-1 {
        transition: all 0.3s;
    }
    .card-statistic-1:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important;
    }
    .recent-activity .activity-item {
        border-left: 2px solid #6777ef;
        margin-bottom: 15px;
        padding-left: 15px;
        position: relative;
    }
    .recent-activity .activity-item:before {
        content: '';
        position: absolute;
        left: -8px;
        top: 0;
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #6777ef;
    }
    .system-health-card .progress {
        height: 10px;
    } */
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h4 class="text-dark font-weight-bold">Ringkasan Sistem</h4>
        <p class="text-muted">Berikut ini adalah data statistik pengguna dan sistem module DAR System.</p>
    </div>
</div>

<!-- Summary Cards -->
<div class="row">
    <!-- User Card -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Pengguna</h4>
                </div>
                <div class="card-body">
                    {{ $user }}
                </div>
                {{-- <div class="card-footer bg-light">
                    <small class="text-muted">Aktif dalam system</small>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Permission Card -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Permission</h4>
                </div>
                <div class="card-body">
                    {{ $permission }}
                </div>
                {{-- <div class="card-footer bg-light">
                    <small class="text-muted">Tersedia dalam system</small>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Module Card -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Module</h4>
                </div>
                <div class="card-body">
                    {{ $module }}
                </div>
                {{-- <div class="card-footer bg-light">
                    <small class="text-muted">Modul dalam system</small>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- Role Card -->
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1 shadow-sm">
            <div class="card-icon bg-success">
                <i class="fas fa-circle"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                    <h4>Total Role</h4>
                </div>
                <div class="card-body">
                    {{ $role }}
                </div>
                {{-- <div class="card-footer bg-light">
                    <small class="text-muted">Peran dalam system</small>
                </div> --}}
            </div>
        </div>
    </div>
</div>

<!-- DAR Statistics Section -->
<div class="row">
    <div class="col-12">
        <h4 class="text-dark font-weight-bold mt-4 mb-3">Statistik Permintaan DAR</h4>
    </div>
</div>

<div class="row">
    <!-- DAR Request Overview -->
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header pb-0">
                <h4>Permintaan DAR Bulanan</h4>
                {{-- <div class="card-header-action">
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm" onclick="filterChart('week')">Minggu Ini</button>
                        <button class="btn btn-primary btn-sm active" onclick="filterChart('month')">Bulan Ini</button>
                        <button class="btn btn-primary btn-sm" onclick="filterChart('year')">Tahun Ini</button>
                    </div>
                </div> --}}
            </div>
            <div class="card-body">
                <canvas id="darRequestChart" height="280"></canvas>
            </div>
        </div>
    </div>
    
    <!-- DAR Status Summary -->
 <div class="col-lg-4">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Status Permintaan</h4>
        </div>
        <div class="card-body">
            <div style="height: 250px; position: relative;">
                <canvas id="darStatusChart"></canvas>
            </div>
            <div class="mt-4">
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-primary">Menunggu</span>
                    <span class="font-weight-bold">{{ $totalPending ?? 0 }}</span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-success">Disetujui</span>
                    <span class="font-weight-bold">{{ $totalApproved ?? 0 }}</span>
                </div>
                <div class="mb-2 d-flex justify-content-between">
                    <span class="text-danger">Ditolak</span>
                    <span class="font-weight-bold">{{ $totalRejected ?? 0 }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Department Distribution and System Health -->
<div class="row">
    <!-- Department Distribution -->
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header">
                <h4>Distribusi Department</h4>
            </div>
            <div class="card-body">
                <canvas id="departmentDistributionChart" height="300"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Variabel global untuk menyimpan instance chart
    let requestChart, statusChart, deptChart;
    
    // Wait for DOM to be fully loaded
    document.addEventListener('DOMContentLoaded', function() {
        // Hancurkan instance chart sebelumnya jika ada
        if (requestChart) requestChart.destroy();
        if (statusChart) statusChart.destroy();
        if (deptChart) deptChart.destroy();
    
        // DAR Request Chart
        const requestCtx = document.getElementById('darRequestChart').getContext('2d');
        requestChart = new Chart(requestCtx, {
            type: 'line',
            data: {
                labels: {!! $monthLabels ?? json_encode(['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']) !!},
                datasets: [{
                    label: 'Total DAR Requests',
                    data: {!! $monthlyTrend ?? json_encode([25, 30, 35, 40, 28, 52, 45, 38, 60, 55, 65, 70]) !!},
                    borderColor: '#6777ef',
                    backgroundColor: 'rgba(103, 119, 239, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: {
                    duration: 800, // Durasi animasi dikurangi
                    easing: 'easeOutQuad'
                },
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // DAR Status Chart - Fixed dengan container yang dibatasi
        if (document.getElementById('darStatusChart')) {
            const statusCtx = document.getElementById('darStatusChart').getContext('2d');
            statusChart = new Chart(statusCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Disetujui', 'Ditolak', 'Menunggu'],
                    datasets: [{
                        data: [{{ $totalApproved ?? 65 }}, {{ $totalRejected ?? 15 }}, {{ $totalPending ?? 20 }}],
                        backgroundColor: ['#47c363', '#fc544b', '#6777ef'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        animateRotate: true,
                        animateScale: false, // Matikan animasi scale untuk mencegah masalah
                        duration: 500 // Kurangi durasi animasi
                    },
                    plugins: {
                        legend: {
                            position: 'bottom',
                            display: true,
                            labels: {
                                boxWidth: 12,
                                padding: 10
                            }
                        },
                        tooltip: {
                            enabled: true
                        }
                    },
                    layout: {
                        padding: 10
                    },
                    cutout: '60%'
                }
            });
        }

        // Department Distribution Chart
        if (document.getElementById('departmentDistributionChart')) {
            const deptCtx = document.getElementById('departmentDistributionChart').getContext('2d');
            deptChart = new Chart(deptCtx, {
                type: 'bar',
                data: {
                    labels: {!! $departmentNames ?? json_encode(['IT', 'HR', 'Finance', 'Marketing', 'Operations', 'Sales']) !!},
                    datasets: [{
                        label: 'Total Users',
                        data: {!! $departmentCounts ?? json_encode([42, 25, 18, 30, 22, 35]) !!},
                        backgroundColor: [
                            'rgba(103, 119, 239, 0.8)',
                            'rgba(71, 195, 99, 0.8)',
                            'rgba(252, 84, 75, 0.8)',
                            'rgba(254, 193, 7, 0.8)',
                            'rgba(23, 162, 184, 0.8)',
                            'rgba(108, 117, 125, 0.8)'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 800 // Kurangi durasi animasi
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: true,
                                color: 'rgba(0, 0, 0, 0.05)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }
        
        // Chart filtering function dengan event handling yang diperbaiki
        // window.filterChart = function(period) {
        //     let newData;
        //     let newLabels;
            
        //     if (period === 'week') {
        //         newData = [10, 15, 12, 8, 18, 14, 20];
        //         newLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        //     } else if (period === 'month') {
        //         newData = [25, 30, 35, 40, 28, 52, 45, 38, 60, 55, 65, 70];
        //         newLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        //     } else if (period === 'year') {
        //         newData = [350, 420, 380, 450, 410, 490];
        //         newLabels = ['2020', '2021', '2022', '2023', '2024', '2025'];
        //     }
            
        //     // Update chart data tanpa animasi berlebihan
        //     requestChart.data.datasets[0].data = newData;
        //     requestChart.data.labels = newLabels;
            
        //     // Update dengan animasi minimal
        //     requestChart.update('none');
            
        //     // Update active button dengan cara yang lebih aman
        //     document.querySelectorAll('.btn-group .btn').forEach(btn => {
        //         btn.classList.remove('active');
        //     });
            
        //     // Pastikan event.target tersedia
        //     if (event && event.target) {
        //         event.target.classList.add('active');
        //     }
        // };
    });
</script>
@endpush