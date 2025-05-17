@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'ApprovedBy1 - Dashboard')

@section('content')
<div class="row">
  <!-- Total Request Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Request DAR</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">3</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Menunggu Approval</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">2</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clock fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Approved Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Approved</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">4</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Rejected Requests Card -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
              Rejected</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">6</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-times-circle fa-2x text-gray-300"></i>
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
          <h6 class="m-0 font-weight-bold text-primary d-inline">Request Menunggu Approval</h6>
        </div>
        <a href="#" class="btn btn-sm btn-primary">Lihat Semua</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No.</th>
                <th>Request ID</th>
                <th>Requester</th>
                <th>Department</th>
                <th>Tanggal Request</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              {{-- @forelse($pendingRequestsList as $index => $request)
              <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $request->request_id }}</td>
                <td>{{ $request->requester_name }}</td>
                <td>{{ $request->department }}</td>
                <td>{{ $request->created_at->format('d M Y') }}</td>
                <td><span class="badge badge-warning">Pending</span></td>
                <td>
                  <a href="{{ route('approval.show', $request->id) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i> Detail
                  </a>
                </td>
              </tr>
              @empty --}}
              <tr>
                {{-- <td colspan="7" class="text-center">Tidak ada request yang menunggu approval</td> --}}
              </tr>
              {{-- @endforelse --}}
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


{{-- <div class="row">
  <!-- Statistik Card Total DAR -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Total Request DAR</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data }}</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistik Card Bulan Ini -->
  <div class="col-xl-6 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Request Bulan Ini</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              {{ $monthlyRequests }}
            </div>
          </div>
          <div class="col-auto">
            <i class="fas fa-calendar fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Detail User Info -->
<div class="row">
  <div class="col-xl-12">
    <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex align-items-center">
        <i class="fas fa-user-circle mr-2"></i>
        <h6 class="m-0 font-weight-bold text-primary">Informasi user detail</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered table-striped" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <td width="15%">NIK</td>
                <td width="35%">: {{ $users->nik }}</td>
                <td width="15%">Email</td>
                <td width="35%">: {{ $users->email }}</td>
              </tr>
              <tr>
                <td>Username</td>
                <td>: {{ $users->username }}</td>
                <td>Department</td>
                <td>: {{ $users->description }}</td>
              </tr>
              <tr>
                <td>Name</td>
                <td>: {{ $users->name }}</td>
                <td>Position</td>
                <td>: {{ $users->position_desc }}</td>
              </tr>
              <tr>
                <td>Company</td>
                <td colspan="3">: {{ $users->company_desc }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div> --}}
