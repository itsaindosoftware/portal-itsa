{{-- filepath: c:\laragon\www\portal-itsa\resources\views\users-dashboard\digassets\user-employee-digassets\home.blade.php --}}
@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Digital Assets - Dashboard')

@section('content')

<div class="container-fluid px-4">
    <div class="card">
    <div class="card-body">
        <h5 class="mb-1"><i class="fas fa-info-circle me-2"></i> Welcome to the Digital Assets Accounting Dashboard {{ Auth::user()->name }}</h5>
        <p class="mb-0">
            This dashboard allows you to register new fixed asset items and manage their accounting records efficiently.
            Please ensure all asset information is entered accurately to support proper tracking and compliance
            You can also review the status of asset registrations and coordinate with other departments as needed.
            For any assistance, please contact the IT support team.
            Thank you for your attention to detail and support in maintaining accurate asset records.
        </p>
    </div>
    </div>


    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-primary-bg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold">Total Request RFA</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalAssets ?? 0 }}</h2>
                        </div>
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-chart-bar text-white fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white bg-opacity-30" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-warning-bg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold">Waiting Approval</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalWaitingAssets ?? 0 }}</h2>
                        </div>
                       <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-layer-group text-white fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white bg-opacity-30" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-success-bg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold">Approved</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalApprovedAssets ?? 0 }}</h2>
                        </div>
                  
                        <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-check-circle text-white fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white bg-opacity-30" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden card-danger-bg">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-white mb-2 fw-semibold">Rejected</h6>
                            <h2 class="display-6 fw-bold text-white mb-0">{{ $totalRejectedAssets ?? 0 }}</h2>
                        </div>
                         <div class="bg-white bg-opacity-20 rounded-circle p-3">
                            <i class="fas fa-exclamation-triangle text-white fs-4"></i>
                        </div>
                    
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-white bg-opacity-30" style="height: 4px;"></div>
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
/* Card Background Colors dengan Gradient */
.card-primary-bg {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.card-warning-bg {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.card-success-bg {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.card-danger-bg {
    background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
}

/* Alternative: Solid Colors */
/*
.card-primary-bg {
    background-color: #0d6efd;
}

.card-warning-bg {
    background-color: #fd7e14;
}

.card-success-bg {
    background-color: #198754;
}

.card-danger-bg {
    background-color: #dc3545;
}
*/

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

.bg-white.bg-opacity-20 {
    background-color: rgba(255, 255, 255, 0.2) !important;
}

.bg-white.bg-opacity-30 {
    background-color: rgba(255, 255, 255, 0.3) !important;
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