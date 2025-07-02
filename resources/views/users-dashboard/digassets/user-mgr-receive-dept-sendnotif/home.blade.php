{{-- filepath: c:\laragon\www\portal-itsa\resources\views\users-dashboard\digassets\user-employee-digassets\home.blade.php --}}
@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Digital Assets - Dashboard')

@section('content')

<div class="container-fluid px-4">
<div class="alert alert-warning mb-4">
    <h5 class="mb-1"><i class="fas fa-info-circle me-2"></i>Welcome to the Digital Assets Management Dashboard {{ Auth::user()->name }}</h5>
    <p class="mb-0">
        This dashboard provides you with a comprehensive overview of all fixed asset registration requests and their approval statuses.<br>
        You can review, approve, or reject asset submissions.
    </p>
</div>
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Total Request</h6>
                            <h2 class="display-6 fw-bold text-primary mb-0">{{ $totalData ?? 0 }}</h2>
                        </div>
                        <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-chart-bar text-primary fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-primary" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Waiting Approval</h6>
                            <h2 class="display-6 fw-bold text-warning mb-0">{{ $totalWaiting ?? 0 }}</h2>
                        </div>
                       <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-layer-group text-warning fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-warning" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Approved</h6>
                            <h2 class="display-6 fw-bold text-success mb-0">{{ $totalApproval ?? 0 }}</h2>
                        </div>
                  
                        <div class="bg-success bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-check-circle text-success fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-success" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Rejected</h6>
                            <h2 class="display-6 fw-bold text-danger mb-0">{{ $totalReject ?? 0 }}</h2>
                        </div>
                         <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                        </div>
                    
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 4px;"></div>
            </div>
        </div>
    </div>

    <!-- Approval Info -->

  
</div>

<style>
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