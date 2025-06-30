@extends('layouts.app_custom')
@section('title-head','Detail Asset Transfer Notification')
@role('user-employee-digassets')
   @section('title','Detail Data')
@endrole

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-info text-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-0">
                                <i class="fas fa-exchange-alt me-2"></i>
                                Asset Transfer Notification Detail
                            </h4>
                            <small class="opacity-75">Transfer ID: {{ $transfer->rfa_number ?? '-' }}</small>
                        </div>
                        <div class="text-end">
                            {{-- <span class="badge bg-{{ $transfer->transfer_status ?? 'warning' }} fs-6 px-3 py-2">
                                {{ $transfer->transfer_status ?? 'Pending Approval' }}
                            </span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Approval Tracking Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-light">
                    <h5 class="mb-0 text-primary">
                        <i class="fas fa-route me-2"></i>
                        Approval Tracking
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <!-- Progress Steps -->
                            <div class="approval-timeline">
                                <div class="timeline-container">
                                    <!-- Step 1: Submitted -->
                                    <input type="hidden" id="id-assetstf" value="{{ $transfer->id_asset_tf }}">
                                    <div class="timeline-step completed">
                                        <div class="timeline-marker">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Request Submitted</h6>
                                            <p class="mb-0 text-muted small">{{ $transfer->created_at ?? '2024-06-26 09:00' }}</p>
                                            <p class="mb-0 text-muted small">By: {{ $transfer->requestor_name ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 2: Department Head Approval -->
                                    <div class="timeline-step {{ ($transfer->approval_status1 ?? 0) == 1 ? 'completed' : (($transfer->approval_status1 ?? 0) == 2 ? 'rejected' : 'pending') }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status1 ?? 0) == 1 ? 'fa-check' : (($transfer->approval_status1 ?? 0) == 2 ? 'fa-times' : 'fa-clock') }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Department Head Approval</h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status1 ?? 0) == 1)
                                                    Approved on {{ $transfer->approval_date1 ?? '2024-06-26 10:30' }}
                                                @elseif(($transfer->approval_status1 ?? 0) == 2)
                                                    Rejected on {{ $transfer->approval_date1 ?? '2024-06-26 10:30' }}
                                                @else
                                                    Waiting for approval
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by1 ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 3: Finance Approval -->
                                    <div class="timeline-step {{ ($transfer->approval_status2 ?? 0) == 1 ? 'completed' : (($transfer->approval_status2 ?? 0) == 2 ? 'rejected' : 'pending') }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status2 ?? 0) == 1 ? 'fa-check' : (($transfer->approval_status2 ?? 0) == 2 ? 'fa-times' : 'fa-clock') }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Manager DIrecture</h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status2 ?? 0) == 1)
                                                    Approved on {{ $transfer->approval_date2 ?? '2024-06-26 11:15' }}
                                                @elseif(($transfer->approval_status2 ?? 0) == 2)
                                                    Rejected on {{ $transfer->approval_date2 ?? '2024-06-26 11:15' }}
                                                @else
                                                    Waiting for approval
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by2 ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 4: Asset Manager Approval -->
                                    <div class="timeline-step {{ ($transfer->approval_status3 ?? 0) == 1 ? 'completed' : (($transfer->approval_status3 ?? 0) == 2 ? 'rejected' : 'pending') }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status3 ?? 0) == 1 ? 'fa-check' : (($transfer->approval_status3 ?? 0) == 2 ? 'fa-times' : 'fa-clock') }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Receiving Department Confirmation</h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status3 ?? 0) == 1)
                                                    Approved on {{ $transfer->approval_date3 ?? '' }}
                                                @elseif(($transfer->approval_status3 ?? 0) == 2)
                                                    Rejected on {{ $transfer->approval_date3 ?? '' }}
                                                @else
                                                    Waiting for approval
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by3 ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 5: Receiving Department Approval -->
                                    <div class="timeline-step {{ ($transfer->approval_status4 ?? 0) == 1 ? 'completed' : (($transfer->approval_status4 ?? 0) == 2 ? 'rejected' : 'pending') }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status4 ?? 0) == 1 ? 'fa-check' : (($transfer->approval_status4 ?? 0) == 2 ? 'fa-times' : 'fa-clock') }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Receiving MGR Department Confirmation</h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status4 ?? 0) == 1)
                                                    Confirmed on {{ $transfer->approval_date4 ?? '' }}
                                                @elseif(($transfer->receiving_dept_status ?? 0) == 2)
                                                    Rejected on {{ $transfer->approval_date4 ?? '' }}
                                                @else
                                                    Waiting for confirmation
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by4 ?? '-' }}</p>
                                        </div>
                                    </div>

                                    <!-- Step 6: Final Approval & ERP Update -->
                                    <div class="timeline-step {{ ($transfer->approval_status5 ?? 0) == 1 ? 'completed' : 'pending' }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status5 ?? 0) == 1 ? 'fa-check' : 'fa-clock' }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">MGR Fin/Acct/CIC</h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status5 ?? 0) == 1)
                                                    Completed on {{ $transfer->approval_date5 ?? '' }}
                                                @else
                                                    Pending system update
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by5 ?? '-' }}</p>
                                        </div>
                                    </div>
                                     <div class="timeline-step {{ ($transfer->approval_status6 ?? 0) == 1 ? 'completed' : 'pending' }}">
                                        <div class="timeline-marker">
                                            <i class="fas {{ ($transfer->approval_status6 ?? 0) == 1 ? 'fa-check' : 'fa-clock' }}"></i>
                                        </div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Finnance/Acct Staff </h6>
                                            <p class="mb-0 text-muted small">
                                                @if(($transfer->approval_status6 ?? 0) == 1)
                                                    Completed on {{ $transfer->approval_date6 ?? '' }}
                                                @else
                                                    Pending system update
                                                @endif
                                            </p>
                                            <p class="mb-0 text-muted small">{{ $transfer->approval_by6 ?? '-' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Transfer Details Section -->
    <div class="row">
        <!-- Section 1: Transfer FROM -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-circle-left me-2"></i>
                        Transfer FROM
                    </h5>
                    <small class="opacity-75">Transferring Department Details</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">Transferring Department:</label>
                                <p class="info-value">{{ $transfer->department_from_name ?? '-' }}</p>
                            </div>
                        </div>
                  
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">Cost Center:</label>
                                <p class="info-value">{{ $transfer->from_cost_center_code ?? 'CC-001' }} - {{ $transfer->from_cost_center_name ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">Asset Description:</label>
                                <p class="info-value">{{ $transfer->product_name ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">IO Number:</label>
                                <p class="info-value">{{ $transfer->from_io_no ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">Asset Tag Number:</label>
                                <p class="info-value">{{ $transfer->rfa_number ?? '-' }}</p>
                            </div>
                        </div>
                              
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">Location:</label>
                                <p class="info-value">{{ $transfer->loc_from ?? '-' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">Quantity:</label>
                                <p class="info-value">{{ $transfer->from_qty ?? '0' }} unit(s)</p>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">PIC Name:</label>
                                <p class="info-value">{{ $transfer->requestor_name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Approval Section -->
                    <div class="bg-light p-3 rounded mt-3">
                        <h6 class="text-secondary mb-2">
                            <i class="fas fa-stamp me-1"></i>
                            Financial Delegation Approval
                        </h6>
                       
                        <div class="row">
                            <div class="col-6">
                                <div class="info-group">
                                    <label class="info-label">Date of Transfer:</label>
                                    <p class="info-value">{{  \Carbon\Carbon::parse($transfer->from_date_of_tf)->format('Y-m-d') ?? '0000-00-00' }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-group">
                                    <label class="info-label">IO Number:</label>
                                    <p class="info-value">{{ $transfer->from_io_no ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section 2: Transfer TO -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-gradient-success text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-arrow-circle-right me-2"></i>
                        Transfer TO
                    </h5>
                    <small class="opacity-75">Receiving Department Details</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">Receiving Department:</label>
                                <p class="info-value">{{ $transfer->department_to_name ?? 'Human Resources Department' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">New Cost Center:</label>
                                <p class="info-value">{{ $transfer->to_cost_center_code ?? 'CC-002' }} - {{ $transfer->to_cost_center_name ?? 'Human Resources' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">New Location:</label>
                                <p class="info-value">{{ $transfer->loc_to ?? 'Building B - Floor 2' }}</p>
                            </div>
                        </div>
                        
                        <div class="col-6 mb-3">
                            <div class="info-group">
                                <label class="info-label">Quantity:</label>
                                <p class="info-value">{{ $transfer->to_qty ?? '1' }} unit(s)</p>
                            </div>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">PIC Name:</label>
                                <p class="info-value">{{ $transfer->to_pic_name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Approval Section -->
                    <div class="bg-light p-3 rounded mt-3">
                        <h6 class="text-secondary mb-2">
                            <i class="fas fa-stamp me-1"></i>
                            Financial Delegation Approval
                        </h6>
                        <div class="row">
                            <div class="col-6">
                                <div class="info-group">
                                    <label class="info-label">Effective Date:</label>
                                    <p class="info-value">{{ $transfer->to_effective_date ?? '0000-00-00' }}</p>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="info-group">
                                    <label class="info-label">Transfer Ref No. ERP:</label>
                                    <p class="info-value">{{ $transfer->to_tf_fer_no_erp ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Additional Information & Documents -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-gradient-secondary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Additional Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @if($transfer->remarks ?? false)
                        <div class="col-12 mb-3">
                            <div class="info-group">
                                <label class="info-label">Remarks/Notes:</label>
                                <p class="info-value">{{ $transfer->remarks }}</p>
                            </div>
                        </div>
                        @endif
                        
                    @if($transfer->pic_support ?? false)
                    <div class="col-12 mb-3">
                        <div class="info-group">
                            <label class="info-label">Supporting Documents:</label>
                            <div class="document-list">
                                @php
                                     $filePath = $transfer->pic_support;
                                    if (!str_starts_with($filePath, 'public/')) {
                                        // Jika filepath dimulai dengan '/', hapus dulu
                                        $filePath = ltrim($filePath, '/');
                                        // Tambahkan 'public/' di depan
                                        $filePath = 'public/' . $filePath;
                                    }
                                    
                                    $fileName = basename($filePath);
                                    $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
                                    $imageExtensions = ['png', 'jpg', 'jpeg', 'gif', 'webp'];
                                    $isImage = in_array($fileExtension, $imageExtensions);
                                    
                                    // URL path untuk akses dari web (tanpa 'public/')
                                    $urlPath = str_replace('public/', '', $filePath);  
                                @endphp
                                {{-- <p>{{  }}</p> --}}
                                
                                <div class="document-item">
                                    @if($isImage)
                                        <!-- Display Image -->
                                        <div class="document-image-container mb-3">
                                            <img src="{{ asset('storage/' . $urlPath) }}" 
                                                alt="{{ $fileName }}" 
                                                class="document-image img-fluid rounded shadow-sm"
                                                onclick="openImageModal('{{ asset('storage/' . $urlPath) }}', '{{ $fileName }}')"
                                                style="max-width: 300px; max-height: 200px; cursor: pointer;">
                                        </div>
                                        <div class="document-info">
                                                <i class="fas fa-image me-2 text-primary"></i>
                                                <span class="document-name">{{ $fileName }}</span>
                                                <small class="text-muted ms-2">(Image File)</small>
                                            </div>
                                        @else
                                            <!-- Display File Link -->
                                            <div class="document-info">
                                                @php
                                                    $fileIcon = match($fileExtension) {
                                                        'pdf' => 'fas fa-file-pdf text-danger',
                                                        'doc', 'docx' => 'fas fa-file-word text-primary',
                                                        'xls', 'xlsx' => 'fas fa-file-excel text-success',
                                                        'ppt', 'pptx' => 'fas fa-file-powerpoint text-warning',
                                                        'txt' => 'fas fa-file-alt text-secondary',
                                                        'zip', 'rar' => 'fas fa-file-archive text-info',
                                                        default => 'fas fa-file text-secondary'
                                                    };
                                                @endphp
                                                <i class="{{ $fileIcon }} me-2"></i>
                                                <a href="{{ asset('storage/' .$urlPath) }}" target="_blank" class="text-decoration-none document-link">
                                                    {{ $fileName }}
                                                </a>
                                                <small class="text-muted ms-2">({{ strtoupper($fileExtension) }} File)</small>
                                            </div>
                                        @endif
                                        
                                        <!-- Download Button -->
                                        <div class="document-actions mt-2">
                                            <a href="{{ asset('storage/' . $urlPath) }}" download="{{ $fileName }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-download me-1"></i>
                                                Download
                                            </a>
                                            @if($isImage)
                                                <button type="button" class="btn btn-sm btn-outline-secondary ms-2" 
                                                        onclick="openImageModal('{{ asset( 'storage/'. $urlPath) }}', '{{ $fileName }}')">
                                                    <i class="fas fa-eye me-1"></i>
                                                    View Full Size
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="d-flex justify-content-between">
                <a href="{{ route('transfernotif.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>
                    Back to List
                </a>
                
                <div class="btn-group">
                    @if(auth()->user()->can('approve_transfer'))
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#approveModal">
                        <i class="fas fa-check me-2"></i>
                        Approve
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#rejectModal">
                        <i class="fas fa-times me-2"></i>
                        Reject
                    </button>
                    @endif
                    
                    {{-- <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print me-2"></i>
                        Print
                    </button>
                    
                    <a href="{{ route('transfernotif.export', $transfer->id_asset_tf) }}" class="btn btn-info">
                        <i class="fas fa-download me-2"></i>
                        Export PDF
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
</div>


<style>
/* Timeline Styles */
.approval-timeline {
    position: relative;
    padding: 20px 0;
}

.timeline-container {
    position: relative;
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.timeline-step {
    display: flex;
    align-items: flex-start;
    position: relative;
}

.timeline-step:not(:last-child)::after {
    content: '';
    position: absolute;
    left: 20px;
    top: 40px;
    height: 30px;
    width: 2px;
    background: #dee2e6;
}

.timeline-step.completed::after {
    background: #28a745;
}

.timeline-step.rejected::after {
    background: #dc3545;
}

.timeline-marker {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
    font-weight: bold;
    margin-right: 20px;
    flex-shrink: 0;
    z-index: 2;
    position: relative;
}

.timeline-step.completed .timeline-marker {
    background: #28a745;
    color: white;
    border: 3px solid #d4edda;
}

.timeline-step.rejected .timeline-marker {
    background: #dc3545;
    color: white;
    border: 3px solid #f8d7da;
}

.timeline-step.pending .timeline-marker {
    background: #ffc107;
    color: #212529;
    border: 3px solid #fff3cd;
}

.timeline-content {
    flex: 1;
    padding-top: 5px;
}

.timeline-content h6 {
    margin-bottom: 5px;
    color: #495057;
    font-weight: 600;
}

/* Info Groups */
.info-group {
    margin-bottom: 15px;
}

.info-label {
    font-weight: 600;
    color: #495057;
    font-size: 14px;
    margin-bottom: 5px;
    display: block;
}

.info-value {
    margin-bottom: 0;
    color: #212529;
    font-size: 15px;
    line-height: 1.4;
}

/* Document List */
.document-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.document-item {
    padding: 10px;
    background: #f8f9fa;
    border-radius: 5px;
    border-left: 3px solid #007bff;
}

/* Gradients */
.bg-gradient-primary {
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #28a745 0%, #1e7e34 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #17a2b8 0%, #117a8b 100%);
}

.bg-gradient-secondary {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
}

/* Responsive */
@media (max-width: 768px) {
    .timeline-container {
        gap: 20px;
    }
    
    .timeline-marker {
        width: 30px;
        height: 30px;
        font-size: 14px;
        margin-right: 15px;
    }
    
    .timeline-step:not(:last-child)::after {
        left: 15px;
        top: 30px;
        height: 20px;
    }
}

/* Print Styles */
@media print {
    .btn, .btn-group {
        display: none !important;
    }
    
    .card {
        border: 1px solid #dee2e6 !important;
        box-shadow: none !important;
    }
    
    .bg-gradient-primary,
    .bg-gradient-success,
    .bg-gradient-info,
    .bg-gradient-secondary {
        background: #f8f9fa !important;
        color: #212529 !important;
    }
}
.document-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.document-item {
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
    border-left: 4px solid #007bff;
    transition: all 0.3s ease;
}

.document-item:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.document-image-container {
    text-align: center;
}

.document-image {
    border: 2px solid #dee2e6;
    transition: all 0.3s ease;
}

.document-image:hover {
    border-color: #007bff;
    transform: scale(1.02);
}

.document-info {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 5px;
}

.document-name {
    font-weight: 500;
    color: #495057;
}

.document-link {
    color: #007bff;
    font-weight: 500;
}

.document-link:hover {
    color: #0056b3;
    text-decoration: underline !important;
}

.document-actions {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

/* Modal Styles */
#modalImage {
    max-width: 100%;
    max-height: 70vh;
    object-fit: contain;
}

/* Responsive */
@media (max-width: 768px) {
    .document-image {
        max-width: 100% !important;
        max-height: 150px !important;
    }
    
    .document-actions {
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    .document-actions {
        display: none !important;
    }
    
    .document-image {
        max-width: 200px !important;
        max-height: 150px !important;
    }
}

</style>

@endsection
@push('js')
@include('digitalassets.send-notif-transfer.user-dashboard.view-modal')
<script>
    let currentModal = null;
   $(document).ready(function() {
    // Debug info
    console.log('Modal script loaded');
    
    if (typeof bootstrap === 'undefined') {
        console.error('Bootstrap not loaded!');
    }
    
  });

function openImageModal(imageSrc, fileName) {
    console.log('Opening modal with:', imageSrc, fileName);
    
    try {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        const modalTitle = document.getElementById('imageModalLabel');
        const downloadBtn = document.getElementById('modalDownloadBtn');
        
        if (!modal || !modalImage || !modalTitle || !downloadBtn) {
            console.error('Modal elements not found!');
            return;
        }
        
        // Set image source dan attributes
        modalImage.src = imageSrc;
        modalImage.alt = fileName;
        modalTitle.textContent = fileName;
        downloadBtn.href = imageSrc;
        downloadBtn.download = fileName;
        
        const bsModal = new bootstrap.Modal(modal);
        bsModal.show();
        
        console.log('Modal should be visible now');
        
    } catch (error) {
        console.error('Error opening modal:', error);
        // Fallback - buka gambar di tab baru
        window.open(imageSrc, '_blank');
    }
}

function closeModal() {
    console.log('closeModal() called');
    
    try {
        if (currentModal) {
            console.log('Closing with Bootstrap 5 instance');
            currentModal.hide();
            return;
        }
        const modalElement = document.getElementById('imageModal');
        
        // Method 3: Fallback dengan jQuery
        console.log('Fallback to jQuery modal hide');
        $('#imageModal').modal('hide');
        
        setTimeout(() => {
            const modal = document.getElementById('imageModal');
            if (modal && modal.classList.contains('show')) {
                // console.log('Manual hide as last resort');
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                
                // Remove backdrop manually
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
            }
        }, 100);
        
    } catch (error) {
        console.error('Error closing modal:', error);
        
        // Emergency fallback
        const modal = document.getElementById('imageModal');
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            document.body.classList.remove('modal-open');
            
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) {
                backdrop.remove();
            }
        }
    }
}


</script>
@endpush
