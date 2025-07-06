@extends('layouts.app')

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
@endsection
