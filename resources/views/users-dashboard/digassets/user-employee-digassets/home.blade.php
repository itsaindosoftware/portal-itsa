{{-- filepath: c:\laragon\www\portal-itsa\resources\views\users-dashboard\digassets\user-employee-digassets\home.blade.php --}}
@extends('layouts.app_custom')

@section('title', 'Dashboard')
@section('title-head', 'Digital Assets - Dashboard')

@section('content')

<div class="container-fluid px-4">
    <div class="alert alert-primary mb-4">
        <h5 class="mb-1"><i class="fas fa-info-circle me-2"></i> Welcome to the Digital Assets Dashboard</h5>
        <p class="mb-0">
            Here, you can submit new fixed asset registration requests and monitor the status of your submissions.<br>
            Please ensure all required information is filled in accurately to support a smooth approval process.<br>
        </p>
    </div>
    <!-- Statistics Cards -->
    <div class="row g-4 mb-5">
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Total Assets</h6>
                            <h2 class="display-6 fw-bold text-primary mb-0">{{ $totalAssets ?? 0 }}</h2>
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
                            <h6 class="card-title text-muted mb-2 fw-semibold">Active Assets</h6>
                            <h2 class="display-6 fw-bold text-success mb-0">{{ $totalActiveAssets ?? 0 }}</h2>
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
                            <h6 class="card-title text-muted mb-2 fw-semibold">Inactive Assets</h6>
                            <h2 class="display-6 fw-bold text-danger mb-0">{{ $totalInactiveAssets ?? 0 }}</h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-exclamation-triangle text-danger fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-danger" style="height: 4px;"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="card h-100 shadow-lg border-0 rounded-3 position-relative overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h6 class="card-title text-muted mb-2 fw-semibold">Asset Groups</h6>
                            <h2 class="display-6 fw-bold text-info mb-0">{{ isset($assetGroups) ? count($assetGroups) : 0 }}</h2>
                        </div>
                        <div class="bg-info bg-opacity-10 rounded-circle p-3">
                            <i class="fas fa-layer-group text-info fs-4"></i>
                        </div>
                    </div>
                </div>
                <div class="position-absolute bottom-0 start-0 w-100 bg-info" style="height: 4px;"></div>
            </div>
        </div>
    </div>

    <!-- Approval Info -->

    <!-- Main Content Row -->
    <div class="row g-4">
        <!-- Asset Group Distribution -->
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-3 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 fw-bold text-dark">
                            <i class="fas fa-chart-pie text-primary me-2"></i>
                            Asset Group Distribution
                        </h5>
                        {{-- <div class="dropdown">
                            <button class="btn btn-outline-secondary btn-sm dropdown-toggle border-0" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-ellipsis-v"></i>
                            </button> --}}
                            {{-- <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="#"><i class="fas fa-download me-2"></i>Export</a></li>
                                <li><a class="dropdown-item" href="#"><i class="fas fa-refresh me-2"></i>Refresh</a></li>
                            </ul> --}}
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="card-body p-4">
                    @if(isset($assetGroups) && count($assetGroups))
                        <div class="row g-3">
                            @foreach($assetGroups as $index => $group)
                                @php
                                    $colors = ['primary', 'success', 'warning', 'info', 'secondary', 'dark'];
                                    $color = $colors[$index % count($colors)];
                                @endphp
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light bg-opacity-50 rounded-3 border border-light">
                                        <div class="bg-{{ $color }} bg-opacity-10 rounded-circle p-2 me-3">
                                            <div class="bg-{{ $color }} rounded-circle" style="width: 12px; height: 12px;"></div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 fw-semibold text-dark">{{ $group->asset_group_name }}</h6>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span class="text-muted small">Total Assets</span>
                                                <span class="badge bg-{{ $color }} bg-opacity-20 text-{{ $color }} fw-semibold">
                                                    {{ $group->total ?? 0 }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="text-muted">
                                <i class="fas fa-chart-pie fa-3x mb-3 opacity-25"></i>
                                <h6 class="mb-2">No Asset Group Data</h6>
                                <p class="small mb-0">Asset group information will appear here once data is available.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="col-lg-4">
            <div class="card shadow-lg border-0 rounded-3 h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-0">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0 fw-bold text-dark">
                            <i class="fas fa-clock text-primary me-2"></i>
                            Recent Activity
                        </h5>
                        <a href="{{ route('digitalassets.index') }}" class="btn btn-outline-primary btn-sm border-0">
                            View All <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="timeline">
                        @if(isset($recentAssets) && count($recentAssets))
                            @foreach($recentAssets as $activity)
                                <div class="timeline-item mb-4 position-relative">
                                    <div class="d-flex">
                                        <div class="flex-shrink-0">
                                            <div class="bg-success bg-opacity-10 rounded-circle p-2">
                                                <i class="fas fa-plus text-success"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="mb-1 fw-semibold">{{ $activity->asset_name ?? 'Asset' }}</h6>
                                            <p class="text-muted small mb-1">
                                                {{ \Carbon\Carbon::parse($activity->created_at)->format('d M Y H:i') }}
                                            </p>
                                            <span class="badge bg-light text-muted small">
                                                {{ ucfirst($activity->status) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="fas fa-clock fa-3x mb-3 opacity-25"></i>
                                    <h6 class="mb-2">No Recent Activity</h6>
                                    <p class="small mb-0">Recent asset activities will appear here once available.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
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