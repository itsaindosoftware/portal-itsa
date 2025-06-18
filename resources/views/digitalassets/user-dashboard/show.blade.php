@extends('layouts.app_custom')
@section('title-head','Digital Assets - Detail Registration Fixed Asset')
{{-- @role('user-employee-digassets')
   @section('title','Detail Digital Assets Registration')
@endrole --}}

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <!-- Approval Status Section -->
    <div class="card approval-card mb-4">
        <div class="card-header approval-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">
                        <i class="fas fa-check-circle text-white mr-2"></i>
                        Approval Workflow Status
                    </h5>
                    <small class="text-white-50">Track the approval progress of this registration</small>
                </div>
                {{-- <div class="approval-badge">
                    <span class="badge badge-status {{ $digitalAsset->status == 'approved' ? 'badge-approved' : ($digitalAsset->status == 'rejected' ? 'badge-rejected' : 'badge-pending') }}">
                        {{ strtoupper($digitalAsset->status ?? 'PENDING') }}
                    </span>
                </div> --}}
            </div>
        </div>
        <div class="card-body approval-body">
            <div class="approval-timeline">
                <div class="row">
                    <!-- Approval 1 -->
                    {{-- <div class="col-md-4">
                        <div class="approval-step {{ $digitalAsset->approval_status1 == 1 ? 'approved' : ($digitalAsset->approval_status1 == 2 ? 'rejected' : 'pending') }}">
                            <div class="approval-icon">
                                  <span>
                                   @if($digitalAsset->approval_status1 == 1)
                                        <i class="fas fa-check-circle"></i>
                                    @elseif($digitalAsset->approval_status1 == 2)
                                        <i class="fas fa-times-circle"></i>
                                    @else
                                        <i class="fas fa-clock"></i>
                                    @endif
                                    </span>
                            </div>
                            <div class="approval-content">
                                <h6 class="approval-title">Approval 1</h6>
                                <p class="approval-role">User</p>
                                <div class="approval-details">
                                    @if($digitalAsset->approval_by1)
                                        <small class="text-muted">
                                            <i class="fas fa-user mr-1"></i>{{ $digitalAsset->approval_by1 ?? 'N/A' }}
                                        </small><br>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar mr-1"></i>{{ $digitalAsset->approval_date1 ? \Carbon\Carbon::parse($digitalAsset->approval_date2)->format('d M Y H:i') : 'N/A' }}
                                        </small><br>
                                        <small class="text-muted">
                                           <i class="fas fa-check-circle mr-1"></i> Approved
                                        </small><br>
                                    @else
                                        <small class="text-muted">Waiting for approval</small>
                                    @endif
                                </div>
                                @if($digitalAsset->remark_approval_by1)
                                    <div class="approval-notes">
                                        <small><strong>Notes:</strong> {{ $digitalAsset->remark_approval_by1 }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div> --}}

                    <!-- Approval 2 -->
                    <div class="col-md-6">
                        <div class="approval-step {{ $digitalAsset->approval_status2 == 1 ? 'approved' : ($digitalAsset->approval_status2 == 2 ? 'rejected' : 'pending') }}">
                            <div class="approval-icon">
                                @if($digitalAsset->approval_status2 == 1)
                                    <i class="fas fa-check-circle"></i>
                                @elseif($digitalAsset->approval_status2 == 2)
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-clock"></i>
                                @endif
                            </div>
                            <div class="approval-content">
                                <h6 class="approval-title">Approval 1</h6>
                                <p class="approval-role">Acounting (Registered)</p>
                                <div class="approval-details">
                                    @if($digitalAsset->approval_by2)
                                        <small class="text-muted">
                                            <i class="fas fa-user mr-1"></i>{{ $digitalAsset->approval_by2 ?? 'N/A' }}
                                        </small><br>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar mr-1"></i>{{ $digitalAsset->approval_date2 ? \Carbon\Carbon::parse($digitalAsset->approval_date2)->format('d M Y H:i') : 'N/A' }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-check-circle mr-1"></i> Approved
                                        </small>
                                    @else
                                        <small class="text-muted">Waiting for approval</small>
                                    @endif
                                </div>
                                @if($digitalAsset->remark_approval_by2)
                                    <div class="approval-notes">
                                        <small><strong>Notes:</strong> {{ $digitalAsset->remark_approval_by2 }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Approval 3 -->
                    <div class="col-md-6">
                        <div class="approval-step {{ $digitalAsset->approval_status3 == 1 ? 'approved' : ($digitalAsset->approval_status3 == 2 ? 'rejected' : 'pending') }}">
                            <div class="approval-icon">
                                @if($digitalAsset->approval_status3 == 1)
                                    <i class="fas fa-check-circle"></i>
                                @elseif($digitalAsset->approval_status3 == 2)
                                    <i class="fas fa-times-circle"></i>
                                @else
                                    <i class="fas fa-clock"></i>
                                @endif
                            </div>
                            <div class="approval-content">
                                <h6 class="approval-title">Approval 2</h6>
                                <p class="approval-role">MD</p>
                                <div class="approval-details">
                                    @if($digitalAsset->approval_by3)
                                        <small class="text-muted">
                                            <i class="fas fa-user mr-1"></i>{{ $digitalAsset->approval_by3 ?? 'N/A' }}
                                        </small><br>
                                        <small class="text-muted">
                                            <i class="fas fa-calendar mr-1"></i>{{ $digitalAsset->approval_date3 ? \Carbon\Carbon::parse($digitalAsset->approval_date3)->format('d M Y H:i') : 'N/A' }}
                                        </small>
                                        <br>
                                        <small class="text-muted">
                                            <i class="fas fa-check-circle mr-1"></i> Approved
                                        </small>
                                    @else
                                        <small class="text-muted">Waiting for approval</small>
                                    @endif
                                </div>
                                @if($digitalAsset->remark_approval_by3)
                                    <div class="approval-notes">
                                        <small><strong>Notes:</strong> {{ $digitalAsset->remark_approval_by3 }}</small>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Detail Card -->
    <div class="card enhanced-card">
        <div class="card-header enhanced-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1">
                        <i class="fas fa-file-alt text-white mr-2"></i>
                        REGISTRATION FIXED ASSET (RFA) - DETAIL
                    </h4>
                    <small class="text-white-50">Registration details and information</small>
                </div>
                <div class="text-right">
                    <span class="badge badge-info">{{ $digitalAsset->rfa_number ?? 'N/A' }}</span>
                </div>
            </div>
        </div>
        <div class="card-body enhanced-body">
            
            <!-- Basic Information Section -->
            <div class="section-divider">
                <h5 class="section-title">
                    <i class="fas fa-info-circle text-info mr-2"></i>
                    Basic Information
                </h5>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-calendar text-muted mr-2"></i>
                            Date
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->date ? \Carbon\Carbon::parse($digitalAsset->date)->format('d M Y') : 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-hashtag text-muted mr-2"></i>
                            RFA Number
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->rfa_number ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-inbox text-muted mr-2"></i>
                            Received Date
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->received_date ? \Carbon\Carbon::parse($digitalAsset->received_date)->format('d M Y') : 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-user text-muted mr-2"></i>
                            Requestor Name & Dept.
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->requestor_name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-barcode text-muted mr-2"></i>
                            Issue Fixed Asset No.
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->issue_fixed_asset_no ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-file-invoice text-muted mr-2"></i>
                            IO No
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->io_no ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-building text-muted mr-2"></i>
                            Company Name
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->company_name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-qrcode text-muted mr-2"></i>
                            Product Code
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->production_code ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-box text-muted mr-2"></i>
                            Product Name
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->product_name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-receipt text-muted mr-2"></i>
                            GRN No
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->grn_no ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Asset Classification Section -->
            <div class="section-divider">
                <h5 class="section-title">
                    <i class="fas fa-layer-group text-success mr-2"></i>
                    Asset Classification
                </h5>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-tags text-muted mr-2"></i>
                            Asset Group
                        </label>
                        <div class="detail-value">
                            <span class="classification-badge asset-group">
                                <i class="fas fa-circle-dot mr-2"></i>
                                {{ $digitalAsset->asset_group_name ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-map-marker-alt text-muted mr-2"></i>
                            Asset Location
                        </label>
                        <div class="detail-value">
                            <span class="classification-badge asset-location">
                                <i class="fas fa-location-dot mr-2"></i>
                                {{ $digitalAsset->name_location ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-dollar-sign text-muted mr-2"></i>
                            Asset Cost Center
                        </label>
                        <div class="detail-value">
                            <span class="classification-badge cost-center">
                                <i class="fas fa-money-bill-wave mr-2"></i>
                                {{ $digitalAsset->cost_center_code ?? 'N/A' }} - {{ $digitalAsset->cost_cname ?? 'N/A' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Audit Information Section -->
            <div class="section-divider">
                <h5 class="section-title">
                    <i class="fas fa-history text-warning mr-2"></i>
                    Audit Information
                </h5>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-user-plus text-muted mr-2"></i>
                            Created By
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->created_by ?? 'N/A' }} 
                            <small class="text-muted">
                                ({{ $digitalAsset->created_at ? $digitalAsset->created_at->format('d M Y H:i') : 'N/A' }})
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail-group">
                        <label class="detail-label">
                            <i class="fas fa-user-edit text-muted mr-2"></i>
                            Last Updated By
                        </label>
                        <div class="detail-value">
                            {{ $digitalAsset->updated_by ?? 'N/A' }} 
                            <small class="text-muted">
                                ({{ $digitalAsset->updated_at ? $digitalAsset->updated_at->format('d M Y H:i') : 'N/A' }})
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="section-divider">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-left enhanced-buttons">
                            <a href="{{ route('digitalassets.index') }}" class="btn btn-secondary btn-enhanced mr-3">
                                <i class="fas fa-arrow-left mr-2"></i>Back to List
                            </a>
                            @can('edit-digitalassets')
                                <a href="{{ route('digitalassets.edit', $digitalAsset->id) }}" class="btn btn-warning btn-enhanced mr-3">
                                    <i class="fas fa-edit mr-2"></i>Edit
                                </a>
                            @endcan
                            @can('delete-digitalassets')
                                <button type="button" class="btn btn-danger btn-enhanced" onclick="confirmDelete({{ $digitalAsset->id }})">
                                    <i class="fas fa-trash mr-2"></i>Delete
                                </button>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Approval Card Styling */
.approval-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    overflow: hidden;
}

.approval-header {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    border: none;
    padding: 20px 25px;
    position: relative;
}

.approval-body {
    padding: 25px;
    background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
}

.approval-timeline {
    position: relative;
}

.approval-step {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    margin-bottom: 15px;
    border: 2px solid #e9ecef;
    transition: all 0.3s ease;
    position: relative;
}

.approval-step.approved {
    border-color: #28a745;
    background: linear-gradient(135deg, #d4edda 0%, #ffffff 100%);
}

.approval-step.rejected {
    border-color: #dc3545;
    background: linear-gradient(135deg, #f8d7da 0%, #ffffff 100%);
}

.approval-step.pending {
    border-color: #ffc107;
    background: linear-gradient(135deg, #fff3cd 0%, #ffffff 100%);
}

.approval-icon {
    position: absolute;
    top: -15px;
    right: 15px;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 16px;
}

.approval-step.approved .approval-icon {
    background: #28a745;
    color: white;
}

.approval-step.rejected .approval-icon {
    background: #dc3545;
    color: white;
}

.approval-step.pending .approval-icon {
    background: #ffc107;
    color: white;
}

.approval-title {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    font-size: 1.1rem;
}

.approval-role {
    color: #6c757d;
    font-size: 0.9rem;
    font-weight: 500;
    margin-bottom: 10px;
}

.approval-details {
    margin-bottom: 8px;
}

.approval-notes {
    background: rgba(0,0,0,0.05);
    padding: 8px;
    border-radius: 6px;
    margin-top: 8px;
}

.badge-status {
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
}

.badge-approved {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.badge-rejected {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    color: white;
}

.badge-pending {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: white;
}

/* Enhanced Card Styling */
.enhanced-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    overflow: hidden;
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
}

.enhanced-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    padding: 20px 25px;
    position: relative;
}

.enhanced-body {
    padding: 30px;
    background: white;
}

/* Section Dividers */
.section-divider {
    margin: 35px 0 25px 0;
    position: relative;
}

.section-title {
    color: #495057;
    font-weight: 600;
    font-size: 1.1rem;
    padding-bottom: 10px;
    border-bottom: 2px solid #e9ecef;
    margin-bottom: 20px;
    position: relative;
}

.section-title::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 50px;
    height: 2px;
    background: linear-gradient(90deg, #667eea, #764ba2);
}

/* Detail Groups */
.detail-group {
    margin-bottom: 25px;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 10px;
    border-left: 4px solid #667eea;
    transition: all 0.3s ease;
}

.detail-group:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.detail-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.95rem;
    display: block;
}

.detail-value {
    font-size: 1rem;
    color: #212529;
    font-weight: 500;
    line-height: 1.4;
}

/* Classification Badges */
.classification-badge {
    display: inline-block;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
}

.asset-group {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
}

.asset-location {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
}

.cost-center {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    color: #212529;
}

/* Enhanced Buttons */
.enhanced-buttons {
    padding: 20px 0;
    border-top: 1px solid #e9ecef;
    margin-top: 30px;
}

.btn-enhanced {
    padding: 12px 30px;
    font-weight: 600;
    border-radius: 25px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    text-transform: none;
    letter-spacing: 0.5px;
}

.btn-enhanced:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.btn-secondary.btn-enhanced {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    border: none;
}

.btn-warning.btn-enhanced {
    background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
    border: none;
    color: #212529;
}

.btn-danger.btn-enhanced {
    background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
    border: none;
}

/* Badge Styling */
.badge-info {
    background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.8rem;
}

/* Icon Styling */
.fas {
    font-weight: 900;
}

.text-primary {
    color: #667eea !important;
}

.text-info {
    color: #17a2b8 !important;
}

.text-success {
    color: #28a745 !important;
}

.text-warning {
    color: #ffc107 !important;
}

/* Responsive Design */
@media (max-width: 768px) {
    .enhanced-body, .approval-body {
        padding: 20px;
    }
    
    .section-divider {
        margin: 25px 0 20px 0;
    }
    
    .approval-step {
        margin-bottom: 20px;
    }
    
    .detail-group {
        margin-bottom: 20px;
        padding: 12px;
    }
}

/* Animation for approval steps */
@keyframes stepPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.approval-step:hover {
    animation: stepPulse 0.3s ease;
}
</style>

@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create a form and submit it
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route("digitalassets.destroy", ":id") }}'.replace(':id', id);
            
            var csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            var methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodInput);
            document.body.appendChild(form);
            form.submit();
        }
    });
}
</script>
@endpush