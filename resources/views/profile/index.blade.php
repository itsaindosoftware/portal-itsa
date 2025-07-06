@extends('layouts.app_custom')
@section('title-head','Digital Assets - Profile')
{{-- @role('user-employee-digassets') --}}
@section('title','My Profile')
{{-- @endrole --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <!-- Profile Header Card -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="profile-header-card">
                <div class="profile-cover">
                    <div class="profile-cover-overlay"></div>
                    <div class="profile-header-content">
                        <div class="row align-items-center">
                            <div class="col-md-3 text-center">
                                <div class="profile-avatar-container text-center">
                                    <div class="profile-avatar">
                                        @if($user->profile_photo ?? false)
                                            <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="Profile Photo" class="avatar-img">
                                        @else
                                            <div class="avatar-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                        <div class="avatar-status online"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="profile-info">
                                    <h2 class="profile-name">{{ $user->name }}</h2>
                                    {{-- <p class="profile-title">{{ $user->job_title ?? 'Digital Assets Manager' }}</p> --}}
                                    <div class="profile-badges">
                                        <span class="profile-badge primary">
                                            <i class="fas fa-envelope"></i>
                                            {{ $user->email }}
                                        </span>
                                        @if($user->department ?? false)
                                        <span class="profile-badge secondary">
                                            <i class="fas fa-building"></i>
                                            {{ $user->department }}
                                        </span>
                                        @endif
                                        @if($user->employee_id ?? false)
                                        <span class="profile-badge info">
                                            <i class="fas fa-id-badge"></i>
                                            {{ $user->employee_id }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-md-3 text-end">
                                <div class="profile-actions">
                                    <button class="btn btn-profile-edit" onclick="editProfile()">
                                        <i class="fas fa-edit"></i>
                                        Edit Profile
                                    </button>
                                    <button class="btn btn-profile-settings" onclick="showSettings()">
                                        <i class="fas fa-cog"></i>
                                    </button>
                                </div>
                                <div class="profile-stats">
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $user->assets_count ?? 0 }}</span>
                                        <span class="stat-label">Assets</span>
                                    </div>
                                    <div class="stat-item">
                                        <span class="stat-number">{{ $user->requests_count ?? 0 }}</span>
                                        <span class="stat-label">Requests</span>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Profile Details Cards -->
    <div class="row">
        <!-- Personal Information -->
        <div class="col-lg-4 mb-4">
            <div class="profile-detail-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-user-circle text-primary"></i>
                        Personal Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-group">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-signature"></i>
                                Full Name
                            </span>
                            <span class="info-value">{{ $user->name }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-envelope"></i>
                                Email Address
                            </span>
                            <span class="info-value">{{ $user->email }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-phone"></i>
                                Phone Number
                            </span>
                            <span class="info-value">{{ $user->phone ?? 'Not provided' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-alt"></i>
                                Join Date
                            </span>
                            <span class="info-value">{{ $user->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-clock"></i>
                                Last Login
                            </span>
                            <span class="info-value">{{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Information -->
        <div class="col-lg-4 mb-4">
            <div class="profile-detail-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-briefcase text-success"></i>
                        Work Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-group">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-id-badge"></i>
                                Employee ID
                            </span>
                            <span class="info-value">{{ $user->nik ?? 'Not assigned' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-building"></i>
                                Department
                            </span>
                            <span class="info-value">{{ $user->department ?? 'Not assigned' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user-tie"></i>
                                Position
                            </span>
                            <span class="info-value">{{ $user->job_title ?? 'Not specified' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-users"></i>
                                Manager
                            </span>
                            <span class="info-value">{{ $user->manager_name ?? 'Not assigned' }}</span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-map-marker-alt"></i>
                                Office Location
                            </span>
                            <span class="info-value">{{ $user->office_location ?? 'Not specified' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="col-lg-4 mb-4">
            <div class="profile-detail-card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-cogs text-warning"></i>
                        System Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="info-group">
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-user-shield"></i>
                                Role
                            </span>
                            <span class="info-value">
                                <span class="badge badge-primary">{{ $user->role ?? 'User' }}</span>
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-key"></i>
                                Permissions
                            </span>
                            <span class="info-value">
                                @if($user->permissions ?? false)
                                    @foreach(explode(',', $user->permissions) as $permission)
                                        <span class="badge badge-outline-info me-1">{{ trim($permission) }}</span>
                                    @endforeach
                                @else
                                    <span class="text-muted">Standard permissions</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-toggle-on"></i>
                                Account Status
                            </span>
                            <span class="info-value">
                                <span class="badge badge-success">Active</span>
                            </span>
                        </div>
                        {{-- <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-shield-alt"></i>
                                Two-Factor Auth
                            </span>
                            <span class="info-value">
                                @if($user->two_factor_enabled ?? false)
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-warning">Disabled</span>
                                @endif
                            </span>
                        </div> --}}
                        {{-- <div class="info-item">
                            <span class="info-label">
                                <i class="fas fa-calendar-check"></i>
                                Email Verified
                            </span>
                            <span class="info-value">
                                @if($user->email_verified_at)
                                    <span class="badge badge-success">Verified</span>
                                @else
                                    <span class="badge badge-danger">Not Verified</span>
                                @endif
                            </span>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Activity & Statistics -->

</div>

<style>
/* Profile Header Card */
.profile-header-card {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.profile-cover {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    position: relative;
    padding: 40px 30px;
    min-height: 280px;
}

.profile-cover-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.profile-header-content {
    position: relative;
    z-index: 2;
}

/* Profile Avatar */
.profile-avatar-container {
    position: relative;
}

.profile-avatar {
    width: 120px;
    height: 120px;
    margin: 0 auto;
    position: relative;
    border-radius: 50%;
    border: 4px solid rgba(255,255,255,0.3);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    overflow: hidden;
}

.avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
    border-radius: 50%;
}

.avatar-status {
    position: absolute;
    bottom: 5px;
    right: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid white;
}

.avatar-status.online {
    background: #28a745;
}

/* Profile Info */
.profile-info {
    color: white;
    padding: 20px 0;
}

.profile-name {
    font-size: 2.2rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: white;
}

.profile-title {
    font-size: 1.1rem;
    opacity: 0.9;
    margin-bottom: 15px;
}

.profile-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
}

.profile-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    background: rgba(255,255,255,0.2);
    border-radius: 20px;
    font-size: 0.85rem;
    color: white;
    backdrop-filter: blur(10px);
}

.profile-badge i {
    font-size: 0.8rem;
}

/* Profile Actions */
.profile-actions {
    margin-bottom: 20px;
}

.btn-profile-edit, .btn-profile-settings {
    border: 2px solid rgba(255,255,255,0.3);
    background: rgba(255,255,255,0.1);
    color: white;
    border-radius: 25px;
    padding: 10px 20px;
    font-weight: 600;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    margin-right: 10px;
}

.btn-profile-edit:hover, .btn-profile-settings:hover {
    background: rgba(255,255,255,0.2);
    color: white;
    transform: translateY(-2px);
}

.btn-profile-settings {
    padding: 10px 15px;
}

/* Profile Stats */
.profile-stats {
    display: flex;
    gap: 20px;
    justify-content: flex-end;
}

.stat-item {
    text-align: center;
    color: white;
}

.stat-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.8rem;
    opacity: 0.8;
}

/* Profile Detail Cards */
.profile-detail-card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    border: none;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.profile-detail-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
}

.profile-detail-card .card-header {
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    padding: 20px 25px;
}

.profile-detail-card .card-title {
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.profile-detail-card .card-body {
    padding: 25px;
}

/* Info Groups */
.info-group {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.info-item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 12px 0;
    border-bottom: 1px solid #f0f0f0;
}

.info-item:last-child {
    border-bottom: none;
}

.info-label {
    display: flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    color: #6c757d;
    font-size: 0.9rem;
    flex: 1;
}

.info-label i {
    width: 16px;
    text-align: center;
    color: #adb5bd;
}

.info-value {
    color: #495057;
    font-weight: 500;
    text-align: right;
    flex: 1;
}

/* Stat Cards */
.stat-card {
    display: flex;
    align-items: center;
    gap: 15px;
    padding: 20px;
    background: #f8f9fa;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.stat-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.stat-content h4 {
    margin: 0;
    font-size: 1.8rem;
    font-weight: 700;
    color: #495057;
}

.stat-content p {
    margin: 0;
    font-size: 0.9rem;
    color: #6c757d;
    font-weight: 500;
}

/* Activity Timeline */
.activity-timeline {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.activity-item {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.activity-icon {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
    flex-shrink: 0;
}

.activity-content {
    flex: 1;
}

.activity-text {
    margin: 0;
    font-weight: 500;
    color: #495057;
    font-size: 0.9rem;
}

.activity-time {
    font-size: 0.8rem;
    color: #6c757d;
}

/* Badges */
.badge {
    font-size: 0.75rem;
    padding: 4px 8px;
    border-radius: 6px;
    font-weight: 500;
}

.badge-outline-info {
    border: 1px solid #17a2b8;
    color: #17a2b8;
    background: transparent;
}

/* Background Colors */
.bg-primary { background-color: #007bff !important; }
.bg-success { background-color: #28a745 !important; }
.bg-warning { background-color: #ffc107 !important; }
.bg-info { background-color: #17a2b8 !important; }
.bg-secondary { background-color: #6c757d !important; }

/* Responsive Design */
@media (max-width: 768px) {
    .profile-cover {
        padding: 30px 20px;
        min-height: 220px;
    }
    
    .profile-name {
        font-size: 1.8rem;
    }
    
    .profile-badges {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .profile-stats {
        justify-content: center;
        margin-top: 15px;
    }
    
    .info-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 5px;
    }
    
    .info-value {
        text-align: left;
    }
    
    .stat-card {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }
}

/* Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.profile-detail-card {
    animation: fadeInUp 0.6s ease forwards;
}

.profile-detail-card:nth-child(1) { animation-delay: 0.1s; }
.profile-detail-card:nth-child(2) { animation-delay: 0.2s; }
.profile-detail-card:nth-child(3) { animation-delay: 0.3s; }
</style>

@endsection

@push('js')
<script>
function editProfile() {
    Swal.fire({
        title: 'Edit Profile',
        text: 'Profile editing functionality will be implemented here.',
        icon: 'info',
        confirmButtonText: 'OK',
        confirmButtonColor: '#667eea'
    });
}

function showSettings() {
    Swal.fire({
        title: 'Profile Settings',
        html: `
            <div class="text-left">
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="emailNotifications" checked>
                    <label class="form-check-label" for="emailNotifications">
                        Email Notifications
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="twoFactor">
                    <label class="form-check-label" for="twoFactor">
                        Two-Factor Authentication
                    </label>
                </div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="privateProfile">
                    <label class="form-check-label" for="privateProfile">
                        Private Profile
                    </label>
                </div>
            </div>
        `,
        showCancelButton: true,
        confirmButtonText: 'Save Settings',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#667eea'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'Settings Saved!',
                text: 'Your profile settings have been updated.',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
        }
    });
}

// Add loading animation
document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.profile-detail-card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endpush