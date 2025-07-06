@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Sys Dev & IT MGR - Dashboard')

@section('content')
<div class="row">
  <!-- Total Request Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
              Total Request DAR</div>
            <div class="h5 mb-0 font-weight-bold text-white">{{ $totalDar }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-white opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
              Waiting Approval</div>
            <div class="h5 mb-0 font-weight-bold text-white">{{ $pending }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clock fa-2x text-white opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Approved Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
              Approved</div>
            <div class="h5 mb-0 font-weight-bold text-white">{{ $approved }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check-circle fa-2x text-white opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Rejected Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-white text-uppercase mb-1">
              Rejected</div>
            <div class="h5 mb-0 font-weight-bold text-white">{{ $rejected }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-times-circle fa-2x text-white opacity-75"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Request Trends -->
<div class="row">
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <i class="fas fa-chart-line mr-2"></i>
        <h6 class="m-0 font-weight-bold text-primary">Trend Request DAR (6 Bulan Terakhir)</h6>
      </div>
      <div class="card-body">
        <div class="chart-area">
          <canvas id="requestTrendChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Department Distribution -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <i class="fas fa-chart-pie mr-2"></i>
        <h6 class="m-0 font-weight-bold text-primary">Distribusi Department</h6>
      </div>
      <div class="card-body">
        <div class="chart-pie">
          <canvas id="departmentPieChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Waiting for Approval Table -->
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center justify-content-between">
        <div>
          <i class="fas fa-tasks mr-2"></i>
          <h6 class="m-0 font-weight-bold text-primary d-inline">Request Waiting Approval</h6>
        </div>
        <a href="{{ route('requestdar.index') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th class="text-center">No.</th>
                <th class="text-center">Request ID</th>
                <th class="text-center">Requester</th>
                <th class="text-center">Department</th>
                <th class="text-center">Tanggal Request</th>
                <th class="text-center">Status</th>
              </tr>
            </thead>
            <tbody>
              @forelse($pendingRequest as $index => $request)
              <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ $request->request_id }}</td>
                <td class="text-center">{{ $request->requester_name }}</td>
                <td class="text-center">{{ $request->department }}</td>
                <td class="text-center">{{ $request->created_at }}</td>
                <td class="text-center"><span class="badge badge-warning">{{ $request->approval_status3 == '0' ? 'Waiting Approval': '-' }}</span></td>
              </tr>
              @empty
              <tr>
                <td colspan="6" class="text-center">No data available</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Recent Activity -->
{{-- <div class="row">
  <div class="col-xl-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <i class="fas fa-history mr-2"></i>
        <h6 class="m-0 font-weight-bold text-primary">Aktivitas Terbaru</h6>
      </div>
      <div class="card-body">
        <div class="activity-timeline">
          @forelse($recentActivities as $activity)
          <div class="activity-item d-flex mb-3">
            <div class="activity-icon
              @if($activity->action == 'approved') bg-success text-white
              @elseif($activity->action == 'rejected') bg-danger text-white
              @else bg-info text-white @endif
              rounded-circle p-3 mr-3">
              @if($activity->action == 'approved')
                <i class="fas fa-check"></i>
              @elseif($activity->action == 'rejected')
                <i class="fas fa-times"></i>
              @else
                <i class="fas fa-pencil-alt"></i>
              @endif
            </div>
            <div class="activity-content">
              <div class="font-weight-bold">{{ $activity->user_name }}</div>
              <div>{{ $activity->description }}</div>
              <div class="text-muted small">{{ $activity->created_at->diffForHumans() }}</div>
            </div>
          </div>
          @empty
          <p class="text-center">Tidak ada aktivitas terbaru</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</div> --}}

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Parse the data from PHP
    const monthLabels = {!! $monthLabels !!};
    const monthlyTrend = {!! $monthlyTrend !!};

    // Department data
    const departmentNames = [
        @foreach($departmentDistribution as $dept)
            "{{ $dept->description }}",
        @endforeach
    ];

    const departmentCounts = [
        @foreach($departmentDistribution as $dept)
            {{ $dept->total }},
        @endforeach
    ];

    // Generate random colors for the pie chart
    function generateRandomColors(count) {
        const colors = [];
        for (let i = 0; i < count; i++) {
            const r = Math.floor(Math.random() * 200);
            const g = Math.floor(Math.random() * 200);
            const b = Math.floor(Math.random() * 200);
            colors.push(`rgba(${r}, ${g}, ${b}, 0.8)`);
        }
        return colors;
    }

    // Configure line chart for Monthly Trends
    const trendCtx = document.getElementById('requestTrendChart');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: monthLabels,
            datasets: [{
                label: 'Request DAR',
                data: monthlyTrend,
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                borderColor: 'rgba(78, 115, 223, 1)',
                pointRadius: 3,
                pointBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointBorderColor: 'rgba(78, 115, 223, 1)',
                pointHoverRadius: 5,
                pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
                pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
                pointHitRadius: 10,
                pointBorderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: "rgb(255, 255, 255)",
                    bodyColor: "#858796",
                    titleMarginBottom: 10,
                    titleColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw + ' request';
                        }
                    }
                }
            }
        }
    });

    // Configure pie chart for Department Distribution
    const deptColors = generateRandomColors(departmentNames.length);
    const pieCtx = document.getElementById('departmentPieChart');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: departmentNames,
            datasets: [{
                data: departmentCounts,
                backgroundColor: deptColors,
                hoverBackgroundColor: deptColors.map(color => color.replace('0.8', '1')),
                hoverBorderColor: "rgba(234, 236, 244, 1)",
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    display: true
                },
                tooltip: {
                    backgroundColor: "rgb(255, 255, 255)",
                    bodyColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    displayColors: false,
                    caretPadding: 10,
                    callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return context.label + ': ' + value + ' (' + percentage + '%)';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endpush