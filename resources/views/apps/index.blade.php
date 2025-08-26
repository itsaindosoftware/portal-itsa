@extends('layouts.app')

@section('content')
<style>
.app-box {
    margin-bottom: 30px !important;
    min-height: 280px;
    border-radius: 15px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.app-box:hover {
    transform: translateY(-5px);
}

.app-content {
    padding: 30px 20px;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.app-title {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 20px 0 15px 0;
    line-height: 1.3;
}

.app-description {
    font-size: 0.95rem;
    opacity: 0.9;
    margin-bottom: 20px;
    line-height: 1.4;
}

@media (max-width: 768px) {
    .app-box {
        margin-bottom: 20px !important;
        min-height: 250px;
    }
    
    .app-content {
        padding: 25px 15px;
    }
    
    .app-title {
        font-size: 1.1rem;
        margin: 15px 0 10px 0;
    }
    
    .app-description {
        font-size: 0.9rem;
        margin-bottom: 15px;
    }
}
</style>
<div class="container py-5">
    <!-- Header -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-2">Select Application</h2>
        <p class="text-muted">Choose an application to get started</p>
        <hr class="w-25 mx-auto" style="height: 3px; background: linear-gradient(90deg, #007bff, #28a745);">
    </div>

    <!-- Application Grid -->
    <div class="row justify-content-center" style="gap: 0; row-gap: 2rem;">
        <!-- Digital Assets App -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-primary">
                @if (auth()->user()->hasPermission('manage-digital-assets'))
                    <a href="{{ route('home') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Digital Assets Registration</h4>
                        <p class="app-description">Manage your digital assets and resources efficiently</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                    <a href="#" class="text-decoration-none" id="digassets-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Digital Assets Registration</h4>
                        <p class="app-description">Manage your digital assets and resources efficiently</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <!-- DAR App -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-success">
                @if (auth()->user()->hasPermission('manage-dar-system'))
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Document Action Request Application</h4>
                        <p class="app-description">Handle DAR requests and workflow management</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                  <a href="#" class="text-decoration-none" id="dar-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Document Action Request Application</h4>
                        <p class="app-description">Handle DAR requests and workflow management</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <!-- IT Request App -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-warning">
                @if (auth()->user()->hasPermission('manage-it-request'))
                <a href="{{ route('it.request.index') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Request</h4>
                        <p class="app-description">Submit and manage IT support requests</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                <a href="#" class="text-decoration-none" id="it-request-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-ticket-alt"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Request</h4>
                        <p class="app-description">Submit and manage IT support requests</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <!-- IT Maintenance Order App -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-danger">
                @if (auth()->user()->hasPermission('manage-it-maintenance'))
                <a href="{{ route('it.maintenance.index') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-wrench"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Maintenance Order</h4>
                        <p class="app-description">Schedule and track IT equipment maintenance</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                <a href="#" class="text-decoration-none" id="it-maintenance-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-wrench"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Maintenance Order</h4>
                        <p class="app-description">Schedule and track IT equipment maintenance</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <!-- IT Borrowing App -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-info">
                @if (auth()->user()->hasPermission('manage-it-borrowing'))
                <a href="{{ route('it.borrowing.index') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Borrowing</h4>
                        <p class="app-description">Request and manage IT equipment borrowing</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                <a href="#" class="text-decoration-none" id="it-borrowing-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                        </div>
                        <h4 class="app-title">IT Borrowing</h4>
                        <p class="app-description">Request and manage IT equipment borrowing</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
            </div>
        </div>

        <!-- Template for more apps -->
        <div class="col-xl-4 col-lg-6 col-md-6 px-3">
            <div class="app-box app-box-secondary coming-soon">
                <div class="app-content">
                    <div class="app-icon-wrapper">
                        <div class="app-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                    <h4 class="app-title">More Apps</h4>
                    <p class="app-description">Additional applications coming soon</p>
                    <div class="app-arrow">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Header -->

    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark mb-2">Select Application</h2>
        <p class="text-muted">Choose an application to get started</p>
        <hr class="w-25 mx-auto" style="height: 3px; background: linear-gradient(90deg, #007bff, #28a745);">
    </div>

    <!-- Application Grid -->
    <div class="row g-4 justify-content-center">
        <!-- Digital Assets App -->
        <div class="col-lg-4 col-md-6">
            <div class="app-box app-box-primary">
                @if (auth()->user()->hasPermission('manage-digital-assets'))
                    <a href="{{ route('home') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Digital Assets Registration</h4>
                        <p class="app-description">Manage your digital assets and resources efficiently</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                    <a href="#" class="text-decoration-none" id="digassets-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-database"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Digital Assets Registration</h4>
                        <p class="app-description">Manage your digital assets and resources efficiently</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
                
            </div>
        </div>

        <!-- DAR App -->
        <div class="col-lg-4 col-md-6">
            <div class="app-box app-box-success">
                @if (auth()->user()->hasPermission('manage-dar-system'))
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Document Action Request Application</h4>
                        <p class="app-description">Handle DAR requests and workflow management</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @else
                  <a href="#" class="text-decoration-none" id="dar-app-link">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Document Action Request Application</h4>
                        <p class="app-description">Handle DAR requests and workflow management</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endif
              
            </div>
        </div>

        <!-- Template for more apps -->
        <div class="col-lg-4 col-md-6">
            <div class="app-box app-box-info coming-soon">
                <div class="app-content">
                    <div class="app-icon-wrapper">
                        <div class="app-icon">
                            <i class="fas fa-plus"></i>
                        </div>
                    </div>
                    <h4 class="app-title">More Apps</h4>
                    <p class="app-description">Additional applications coming soon</p>
                    <div class="app-arrow">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Example: Add more apps here -->
        <!--
        <div class="col-lg-4 col-md-6">
            <div class="app-box">
                <a href="#" class="text-decoration-none">
                    <div class="app-content">
                        <div class="app-icon-wrapper">
                            <div class="app-icon bg-warning">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                        </div>
                        <h4 class="app-title">Analytics</h4>
                        <p class="app-description">View reports and analytics dashboard</p>
                        <div class="app-arrow">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        -->
    </div>
</div>
@endsection --}}
