{{-- filepath: c:\laragon\www\portal-itsa\resources\views\users-dashboard\digassets\user-employee-digassets\home.blade.php --}}
@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Digital Assets - Dashboard')

@section('content')

<div class="container-fluid px-4">
<div class="card">
    <div class="card-body">
       <h5 class="mb-1"><i class="fas fa-info-circle me-2"></i>Welcome to the Digital Assets Management Dashboard {{ Auth::user()->name }}</h5>
        <p class="mb-0">
            This dashboard provides you with a comprehensive overview of all fixed asset registration requests and their approval statuses.<br>
            You can review, approve, or reject asset submissions.
        </p>
    </div>
</div>
{{-- <div class="alert alert-warning mb-4">

</div> --}}
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-gradient-blue">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold opacity-90">Total Request</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalData ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white opacity-25" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-gradient-orange">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold opacity-90">Waiting Approval</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalWaiting ?? 0 }}</h2>
                        </div>
                       <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-layer-group"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white opacity-25" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-gradient-green">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold opacity-90">Approved</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalApproval ?? 0 }}</h2>
                        </div>
                  
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white opacity-25" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-gradient-red">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold opacity-90">Rejected</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalReject ?? 0 }}</h2>
                        </div>
                         <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white opacity-25" style="height: 4px;"></div>
            </div>
        </div>
    </div>

    <!-- Approval Info -->

   <div class="row">
        <div class="col-xl-12">
        <div class="card shadow mb-4">
          <div class="card-header py-3 d-flex align-items-center">
            <i class="fas fa-user-circle mr-2"></i>
            <h6 class="m-0 font-weight-bold text-primary">Informasi User Detail</h6>
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
  </div>
</div>

<style>
/* Gradient Card Backgrounds */
.card-gradient-blue {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-gradient-orange {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-gradient-green {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.card-gradient-red {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

/* Alternative: Solid color backgrounds */
.card-solid-blue {
    background: #4e73df;
}

.card-solid-orange {
    background: #f6c23e;
}

.card-solid-green {
    background: #1cc88a;
}

.card-solid-red {
    background: #e74a3b;
}

/* Alternative: Subtle gradient backgrounds */
.card-subtle-blue {
    background: linear-gradient(135deg, #74b9ff 0%, #0984e3 100%);
}

.card-subtle-orange {
    background: linear-gradient(135deg, #fdcb6e 0%, #e17055 100%);
}

.card-subtle-green {
    background: linear-gradient(135deg, #55efc4 0%, #00b894 100%);
}

.card-subtle-red {
    background: linear-gradient(135deg, #fd79a8 0%, #e84393 100%);
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    bottom: -20px;
    width: 2px;
    background: linear-gradient(to bottom, #e9ecef, transparent);
}

.timeline-item:last-child::before {
    display: none;
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.bg-opacity-10 {
    background-color: rgba(var(--bs-primary-rgb), 0.1) !important;
}

.bg-success.bg-opacity-10 {
    background-color: rgba(var(--bs-success-rgb), 0.1) !important;
}

.bg-danger.bg-opacity-10 {
    background-color: rgba(var(--bs-danger-rgb), 0.1) !important;
}

.bg-info.bg-opacity-10 {
    background-color: rgba(var(--bs-info-rgb), 0.1) !important;
}

.bg-warning.bg-opacity-10 {
    background-color: rgba(var(--bs-warning-rgb), 0.1) !important;
}

.bg-secondary.bg-opacity-10 {
    background-color: rgba(var(--bs-secondary-rgb), 0.1) !important;
}

.bg-dark.bg-opacity-10 {
    background-color: rgba(var(--bs-dark-rgb), 0.1) !important;
}

@media (max-width: 768px) {
    .display-6 {
        font-size: 1.5rem;
    }
    
    .container-fluid {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}
</style>
@endsection