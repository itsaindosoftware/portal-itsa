@extends('layouts.app_custom')
@section('title-head','Digital Assets - Registration Fixed Asset')
@role('user-employee-digassets')
   @section('title','Create Request Digital Assets')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card enhanced-card">
        <div class="card-header enhanced-header">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="card-title mb-1">
                        <i class="fas fa-file-alt text-primary mr-2"></i>
                        REGISTRATION FIXED ASSET (RFA)
                    </h4>
                    <small class="text-primary">Please fill all required information carefully</small>
                </div>
                {{-- <div class="text-right">
                    <span class="badge badge-info">IP/FAW/22/APR/0002</span>
                </div> --}}
            </div>
        </div>
        <div class="card-body enhanced-body">
            <form action="{{ route('digitalassets.store') }}" method="POST">
                @csrf
                
                <!-- Basic Information Section -->
                <div class="section-divider">
                    <h5 class="section-title">
                        <i class="fas fa-info-circle text-info mr-2"></i>
                        Basic Information
                    </h5>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="date" class="enhanced-label">
                                <i class="fas fa-calendar text-muted mr-1"></i>
                                Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control enhanced-input" id="date" placeholder="DATE" name="date" readonly>
                            <small class="form-text text-muted">
                                <i class="fas fa-user-tie mr-1"></i>(Fill by Accounting)
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="rfa_number" class="enhanced-label">
                                <i class="fas fa-hashtag text-muted mr-1"></i>
                                RFA Number <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="rfa_number" placeholder="RFA Number" name="rfa_number" readonly>
                            <small class="form-text text-muted">
                                <i class="fas fa-user-tie mr-1"></i>(Fill by Accounting)
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="received_date" class="enhanced-label">
                                <i class="fas fa-inbox text-muted mr-1"></i>
                                Received Date <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control enhanced-input" id="received_date" name="received_date" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with received date that asset come in ITSP)
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="requestor" class="enhanced-label">
                                <i class="fas fa-user text-muted mr-1"></i>
                                Requestor Name & Dept. <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="requestor_name" name="requestor_name" placeholder="Enter requestor name and department" value="{{ $userData->name ?? '' }} ({{ $userData->description ?? '' }})" readonly required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with PIC Name requestor & Dept. Requestor)
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="issue_fixed_asset_no" class="enhanced-label">
                                <i class="fas fa-barcode text-muted mr-1"></i>
                                Issue Fixed Asset No. <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="issue_fixed_asset_no" name="issue_fixed_asset_no" placeholder="Enter issue fixed asset number" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with no. of Issue Fixed Asset)
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="io_no" class="enhanced-label">
                                <i class="fas fa-file-invoice text-muted mr-1"></i>
                                IO No <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="io_no" name="io_no" placeholder="Enter IO number" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with IO No. of asset)
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="company_name" class="enhanced-label">
                                <i class="fas fa-building text-muted mr-1"></i>
                                Company Name <span class="text-danger">*</span>
                            </label>
                            <select class="form-control enhanced-input" id="company_id" name="company_id" required>
                                <option value="">Select Company</option>
                                @foreach($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->company_desc }}</option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill Company)
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="product_code" class="enhanced-label">
                                <i class="fas fa-qrcode text-muted mr-1"></i>
                                Product Code <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="product_code" name="product_code" placeholder="Enter product code" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with product code asset. If have many product code can mention as attached)
                            </small>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="product_name" class="enhanced-label">
                                <i class="fas fa-box text-muted mr-1"></i>
                                Product Name <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="product_name" name="product_name" placeholder="ADDITIONAL M&E AIR COMPRESSOR" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with product name asset. If have many product code can mention as attached)
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group enhanced-form-group">
                            <label for="grn_no" class="enhanced-label">
                                <i class="fas fa-receipt text-muted mr-1"></i>
                                GRN No <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control enhanced-input" id="grn_no" name="grn_no" placeholder="IP/RPO/22/MAR/3354" required>
                            <small class="form-text text-muted">
                                <i class="fas fa-info-circle mr-1"></i>(Please fill with GRN No.)
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Asset Group Section -->
                <div class="section-divider">
                    <h5 class="section-title">
                        <i class="fas fa-layer-group text-success mr-2"></i>
                        Asset Classification
                    </h5>
                </div>

                <div class="form-group enhanced-radio-group">
                    <label class="form-label enhanced-label">
                        <i class="fas fa-tags text-muted mr-1"></i>
                        <strong>Asset Group</strong>
                    </label>
                    <small class="form-text text-muted mb-3">
                        <i class="fas fa-hand-point-right mr-1"></i>(Please select one asset group)
                    </small>
                    <div class="radio-container">
                        <div class="row">
                            @foreach($assetGroups as $index => $group)
                                <div class="col-md-4">
                                    <div class="form-check enhanced-radio">
                                        <input class="form-check-input" type="radio" 
                                            id="asset_group_{{ $group->id }}" 
                                            name="asset_group" 
                                            value="{{ $group->id }}">
                                        <label class="form-check-label" for="asset_group_{{ $group->id }}">
                                            <i class="fas fa-circle-dot mr-2"></i>
                                            {{ $group->asset_group_name }}
                                        </label>
                                    </div>
                                </div>
                                @if(($index + 1) % 7 == 0)
                                    </div><div class="row">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Asset Location Section -->
                <div class="form-group enhanced-radio-group">
                    <label class="form-label enhanced-label">
                        <i class="fas fa-map-marker-alt text-muted mr-1"></i>
                        <strong>Asset Location</strong>
                    </label>
                    <small class="form-text text-muted mb-3">
                        <i class="fas fa-hand-point-right mr-1"></i>(Please select one asset location)
                    </small>
                    <div class="radio-container">
                        <div class="row">
                            @foreach($assetLocations as $index => $location)
                                <div class="col-md-4">
                                    <div class="form-check enhanced-radio">
                                        <input class="form-check-input" type="radio"
                                            id="asset_location_{{ $location->id }}"
                                            name="asset_location"
                                            value="{{ $location->id }}">
                                        <label class="form-check-label" for="asset_location_{{ $location->id }}">
                                            <i class="fas fa-location-dot mr-2"></i>
                                            {{ $location->asset_location_name }}
                                        </label>
                                    </div>
                                </div>
                                @if(($index + 1) % 6 == 0)
                                    </div><div class="row">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Asset Cost Center Section -->
                <div class="form-group enhanced-radio-group">
                    <label class="form-label enhanced-label">
                        <i class="fas fa-dollar-sign text-muted mr-1"></i>
                        <strong>Asset Cost Center</strong>
                    </label>
                    <small class="form-text text-muted mb-3">
                        <i class="fas fa-hand-point-right mr-1"></i>(Please select one cost center)
                    </small>
                    <div class="radio-container">
                        <div class="row">
                            @foreach($assetCostCenters as $index => $costCenter)
                                <div class="col-md-4">
                                    <div class="form-check enhanced-radio">
                                        <input class="form-check-input" type="radio"
                                            id="cc_{{ $costCenter->id }}"
                                            name="asset_cost_center"
                                            value="{{ $costCenter->id }}">
                                        <label class="form-check-label" for="cc_{{ $costCenter->id }}">
                                            <i class="fas fa-money-bill-wave mr-2"></i>
                                            {{ $costCenter->cost_center_code }} - {{ $costCenter->cost_center_name }}
                                        </label>
                                    </div>
                                </div>
                                @if(($index + 1) % 6 == 0)
                                    </div><div class="row">
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="section-divider">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-left enhanced-buttons">
                                <a href="{{ route('digitalassets.index') }}" type="button" class="btn btn-secondary btn-enhanced mr-3">
                                    <i class="fas fa-times mr-2"></i>Cancel
                                </a>
                                <button type="submit" class="btn btn-primary btn-enhanced">
                                    <i class="fas fa-paper-plane mr-2"></i>Submit Registration
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
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

.enhanced-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.enhanced-header .card-title {
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
    position: relative;
    z-index: 1;
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

/* Enhanced Form Groups */
.enhanced-form-group {
    margin-bottom: 25px;
    position: relative;
}

.enhanced-label {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    font-size: 0.95rem;
}

.enhanced-input {
    border: 2px solid #e9ecef;
    border-radius: 10px;
    padding: 12px 15px;
    font-size: 0.95rem;
    transition: all 0.3s ease;
    background: #fafbfc;
}

.enhanced-input:focus {
    border-color: #667eea;
    background: white;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15);
    transform: translateY(-1px);
}

.enhanced-input::placeholder {
    color: #adb5bd;
    font-style: italic;
}

/* Enhanced Radio Groups */
.enhanced-radio-group {
    background: #f8f9fa;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
    border: 1px solid #e9ecef;
}

.radio-container {
    background: white;
    border-radius: 8px;
    padding: 15px;
    border: 1px solid #dee2e6;
}

.enhanced-radio {
    margin-bottom: 12px;
    padding: 8px 12px;
    border-radius: 8px;
    transition: all 0.2s ease;
    background: transparent;
}

.enhanced-radio:hover {
    background: #f1f3f4;
    transform: translateX(3px);
}

.enhanced-radio .form-check-input {
    width: 18px;
    height: 18px;
    margin-top: 0.1em;
    border: 2px solid #667eea;
}

.enhanced-radio .form-check-input:checked {
    background-color: #667eea;
    border-color: #667eea;
}

.enhanced-radio .form-check-label {
    font-size: 0.92rem;
    color: #495057;
    font-weight: 500;
    margin-left: 8px;
    cursor: pointer;
    transition: color 0.2s ease;
}

.enhanced-radio .form-check-input:checked + .form-check-label {
    color: #667eea;
    font-weight: 600;
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

.btn-primary.btn-enhanced {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
}

.btn-secondary.btn-enhanced {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    border: none;
}

/* Form Text Enhancements */
.form-text {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 5px;
    font-style: italic;
}

.text-danger {
    color: #dc3545 !important;
    font-weight: 600;
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

/* Responsive Enhancements */
@media (max-width: 768px) {
    .enhanced-body {
        padding: 20px;
    }
    
    .section-divider {
        margin: 25px 0 20px 0;
    }
    
    .enhanced-radio-group {
        padding: 15px;
    }
    
    .radio-container {
        padding: 10px;
    }
}

/* Loading Animation for Form */
.enhanced-input:focus {
    animation: inputFocus 0.3s ease;
}

@keyframes inputFocus {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

/* Icon Styling */
.fas {
    font-weight: 900;
}

.text-primary {
    color: #f5f5f5 !important;
}

.text-info {
    color: #17a2b8 !important;
}

.text-success {
    color: #28a745 !important;
}

/* Enhanced Visual Feedback */
.enhanced-radio .form-check-input:checked + .form-check-label i {
    color: #667eea;
    animation: checkPulse 0.3s ease;
}

@keyframes checkPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.2); }
    100% { transform: scale(1); }
}
</style>

@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function() {
    $('form').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: formData,
            beforeSend: function() {
                // Optional: show loading indicator
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Digital Asset successfully registered!',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = "{{ route('digitalassets.index') }}";
                });
            },
            error: function(xhr) {
                let msg = 'An error occurred. Please check your data.';
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    msg = Object.values(errors).map(e => e.join('<br>')).join('<br>');
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    html: msg
                });
            }
        });
    });
});
</script>
@endpush