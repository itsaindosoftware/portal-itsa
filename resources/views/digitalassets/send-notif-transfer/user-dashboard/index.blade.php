@extends('layouts.app_custom')
@section('title-head','Transfer Asset Notification')
@role('user-employee-digassets')
   @section('title','Transfer Asset Notification')
@endrole
@role('admin')
   @section('title','History Transfer Asset Notification')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/bootstrap-datetimepicker.min.css') }}">
@endsection
@section('content')
<div class="section-body">
    		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-info alert-dismissible show fade">
							<div class="alert-icon"></div>
							<div class="alert-body">
								<div class="alert-title"><i class="fas fa-info-circle"></i> Guidance Notes</div>
								<ul class="mb-0">
									<li>This is the Asset Transfer Notification Dashboard</li>
									<li>Please use the date range filter to search for data based on date ranges</li>
                                    <li>Please use the search input to search for specific data located above the right of the data table list.</li>
								</ul>
							</div>
							<button class="close" data-dismiss="alert">
								<span>×</span>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
           <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Filter Data</h4>
						<div class="card-header-action">
							<a data-collapse="#filter-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
						</div>
					</div>
					<div class="collapse show" id="filter-collapse">
				
						<div class="card-body">
							<form id="filter-form">
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label>Date Range</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<div class="input-group-text">
														<i class="fas fa-calendar"></i>
													</div>
												</div>
												<input type="text" placeholder="Select Date Range" class="form-control daterange-picker" name="date_range" id="date_range">
											</div>
										</div>
									</div>
	
									<div class="col-md-3">
										<div class="form-group mt-4 pt-1">
											<button type="button" class="btn btn-primary" id="btn-filter">
												<i class="fas fa-filter"></i> Apply Filter
											</button>
											<button type="button" class="btn btn-light" id="btn-reset">
												<i class="fas fa-undo"></i> Reset
											</button>
										</div>
									</div>
								</div>
                                <input type="hidden" name="group_by" id="group_by" value="department">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						@if(session()->has('success'))
						<div class="alert alert-success alert-dismissible show fade">
	                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
	                      <div class="alert-body">
	                        <div class="alert-title">Success</div>
	                        {{ session()->get('success') }}
	                        </div>
	                         <button class="close" data-dismiss="alert">
	                          <span>×</span>
	                        </button>
	                    </div>
	                     @endif
						<div class="table-responsive">
							<table class="table table-bordered dataTable no-footer" id="table-request-manage" width="100%" role="grid" aria-describedby="table-1_info">
								<thead>
									<tr>
										<th width="7%">No.</th>
										<th class="text-center">Date</th>
								        <th class="text-center">RFA Number</th>
                                        <th class="text-center">production_code</th>
                                        <th class="text-center">product_name</th>
                                        <th class="text-center">Requestor Name</th>
										<th class="text-center" width="15%">Action</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
    {{-- @endrole --}}

@endsection
@push('js')
@include('digitalassets.send-notif-transfer.user-dashboard.sendnotif-modal')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/daterangepicker.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

$(document).ready(function() {
        // Initialize date range picker
        $('.daterange-picker').daterangepicker({
            locale: {
                format: 'YYYY-MM-DD'
            },
            autoUpdateInput: false,
            opens: 'left'
        });

        $('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('.daterange-picker').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
});
$(document).on('click', '#edit-data-notif', function(e) {
    e.preventDefault();
		Swal.fire({
			icon: 'info',
			title: 'Edit Not Allowed',
			text: 'You cannot edit this digital asset as it has already been approved.',
			confirmButtonText: 'OK'
		});
});
$(document).ready(function(){
        // $('.addrm').prop('disabled', true);

		var table = $('#table-request-manage').DataTable({
			"columnDefs": [{
				"searchable": false,
				"orderable": false,
				"targets": 0,
				render: function(data, type, row, meta) {
					return meta.row + meta.settings._iDisplayStart + 1;
				},
			}],
			processing: true,
			serverSide: true,
			deferRender:true,
			ajax: {
				url: "{{ route('transfernotif.index') }}",
                 data: function(d) {
                    d.date_range = $('#date_range').val();
                 }
			},
			order: [[ 0, 'desc']],
			responsive: true,
			columns: [
			{
				data: null,
				name: null,
				orderable: false,
				searchable: false,
				className: 'text-center'
			},
			{ data: 'date', name: 'date', className: 'text-center' },
			{ data: 'rfa_number', name: 'rfa_number', className:'text-center' },
            { data: 'production_code', name: 'production_code',className: 'text-center' },
            { data: 'product_name', name: 'product_name',className: 'text-center' },
            { data: 'requestor_name', name: 'requestor_name',className: 'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
});
$(document).ready(function() {
    // Handle filter button click
    $('#btn-filter').on('click', function() {
      $('#table-request-manage').DataTable().ajax.reload();
    });

    // Handle reset button click
    $('#btn-reset').on('click', function() {
        $('#filter-form')[0].reset();
        $('.daterange-picker').val('');
        $('#table-request-manage').DataTable().ajax.reload();
    });
});

$(document).on('click','#sendnotif-data', function(e){         
    e.preventDefault();         
    // resetForm(); 
    var href = $(this).data('href');
    
    // Show loading state
    $('#create-digassets').modal('show');
    showLoadingState();

    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
			// console.log(response)
            hideLoadingState();
            
            if(response.success) {
                // Fill form with data
                populateForm(response.data);
            } else {
                showAlert('error', response.message || 'Failed to load data');
            }
        },
        error: function(xhr, status, error) {
            hideLoadingState();
            console.error('AJAX Error:', error);
            showAlert('error', 'Failed to load data. Please try again.');
        }
    });
});

// Function to populate form with data
function populateForm(data) {
    // Section 1: Transfer FROM
	if(data.id) $('#id-fix-reg-assets').val(data.id);
    if(data.department_id) $('#transferring-dept').val(data.department_id).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
            $(this).blur();
    });

    if(data.department_id) $('#cost-center-from').val(data.department_id).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
        $(this).blur();
    });

    if(data.product_name) $('#item-description').val(data.product_name).prop('readonly', true);

    if(data.io_no) $('#io-no-from').val(data.io_no).prop('readonly', true);

    if(data.rfa_number) $('#asset-tag-number').val(data.rfa_number).prop('readonly', true);

    if(data.asset_location_id) $('#location-from').val(data.asset_location_id).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
            $(this).blur();
    });

    if(data.quantity_from) $('#quantity-from').val(data.quantity_from).prop('readonly', true);
    if(data.requestor_name) $('#pic-name-from').val(data.requestor_name).prop('readonly', true);
    // if(data.date_of_transfer) $('#date_of_transfer').val(data.date_of_transfer);x`x
    if(data.io_no_approval) $('#io-no-approval').val(data.io_no_approval);
    
    // if(data.asset_group) $('#asset_group').val(data.asset_group).trigger('change');
    
    // Remove any validation error classes
    $('.is-invalid').removeClass('is-invalid');
}
function hideLoadingState() {
    $('#loading-overlay').remove();
    
    // Enable form elements
    $('#reqdigassetsForm input, #reqdigassetsForm select, #reqdigassetsForm textarea').prop('disabled', false);
}
function showLoadingState() {
    const modalBody = $('#create-digassets .modal-body');
    modalBody.prepend(`
        <div id="loading-overlay" class="text-center py-4">
            <div class="spinner-border text-info" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Loading data...</p>
        </div>
    `);
    
    // Disable form elements
    $('#reqdigassetsForm input, #reqdigassetsForm select, #reqdigassetsForm textarea').prop('disabled', true);
}
function showAlert(type, message) {
    const alertClass = type === 'error' ? 'alert-danger' : 'alert-success';
    const alertHtml = `
        <div class="alert ${alertClass} alert-dismissible fade show" role="alert">
            <strong>${type === 'error' ? 'Error!' : 'Success!'}</strong> ${message}
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    // Insert alert at the top of modal body
    $('#create-digassets .modal-body').prepend(alertHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        $('.alert').fadeOut();
    }, 5000);
}

// Enhanced closeModal function
function closeModal() {
    $('#create-digassets').modal('hide');
    resetForm();
}

// Function to reset form
function resetForm() {
    $('#reqdigassetsForm')[0].reset();
    
    // Remove validation classes
    document.querySelectorAll('.is-invalid').forEach(field => {
        field.classList.remove('is-invalid');
    });
    
    // Remove any alerts
    $('.alert').remove();
    
    // Reset file input label if exists
    const fileLabel = document.querySelector('.custom-file-label');
    if (fileLabel) {
        fileLabel.innerText = 'Choose files...';
    }
    
    hideLoadingState();
}


$(document).ready(function() {
    
    // Form submit handler
    $('.submitTransfer').on('click', function() {
        clearValidationErrors();
        
        // Validate form
        if (!validateForm()) {
            return false;
        }
        
        // Show loading state
        showSubmitLoading();
		var form = $('#reqdigassetsForm')[0]; // Get the DOM element, not jQuery object
        var formData = new FormData(form);
        // Prepare form data

		var actionUrl = $('#reqdigassetsForm').attr('action');
        // console.log(formData);
        // Submit via AJAX
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json' // Ensure JSON response
            },
            dataType: 'json', // Expect JSON response
			beforeSend: function(xhr) {
                console.log('AJAX request about to be sent');
            },
            success: function(response) {
                console.log('Success response:', response); // Debug log
                hideSubmitLoading();
                handleSubmitSuccess(response);
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', xhr, status, error); // Debug log
                hideSubmitLoading();
                handleSubmitError(xhr);
            }
        });
    });
});

function validateForm() {
    let isValid = true;
    const form = document.getElementById('reqdigassetsForm');
    
    // Clear previous errors
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    
    // Required fields validation
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        const value = field.type === 'select-one' ? field.value : field.value.trim();
        
        if (!value) {
            markFieldInvalid(field, 'This field is required');
            isValid = false;
        }
    });
    
    // Custom validations
    
    // 1. Check if quantities match
    const qtyFrom = $('#quantity-from').val();
    const qtyTo = $('#quantity-to').val();
    if (qtyFrom !== qtyTo) {
        markFieldInvalid($('#quantity-to')[0], 'Quantity must match in both sections');
        isValid = false;
    }
    
    // 2. Validate dates
    const transferDate = $('#date-of-transfer').val();
    const effectiveDate = $('#effective-date').val();
    
    if (transferDate && effectiveDate) {
        if (new Date(effectiveDate) < new Date(transferDate)) {
            markFieldInvalid($('#effective-date')[0], 'Effective date cannot be earlier than transfer date');
            isValid = false;
        }
    }
    
    // 3. Validate asset tag number format (if exists)
    const assetTag = $('#asset-tag-number').val();
    if (assetTag && !/^[A-Z0-9]{6,}$/.test(assetTag.trim())) {
        markFieldInvalid($('#asset-tag-number')[0], 'Asset tag must be at least 6 characters (letters and numbers only)');
        isValid = false;
    }
    
    // 4. Check if transferring and receiving departments are different
    const transferringDept = $('#transferring-dept').val();
    const receivingDept = $('#receiving-dept').val();
    if (transferringDept && receivingDept && transferringDept === receivingDept) {
        markFieldInvalid($('#receiving-dept')[0], 'Receiving department must be different from transferring department');
        isValid = false;
    }
    
    // 5. Validate IO numbers (if exists)
    const ioFrom = $('#io-no-approval').val();
    if (ioFrom && ioFrom.trim() && !/^IO[0-9]{6,}$/.test(ioFrom.trim())) {
        markFieldInvalid($('#io-no-approval')[0], 'IO number format should be IO followed by at least 6 digits');
        isValid = false;
    }
    
    // Show validation summary if there are errors
    if (!isValid) {
        showValidationSummary();
        scrollToFirstError();
    }
    
    return isValid;
}

// Mark field as invalid with error message
function markFieldInvalid(field, message) {
    $(field).addClass('is-invalid');
    
    // Add error message
    const errorDiv = $(`<div class="invalid-feedback">${message}</div>`);
    $(field).after(errorDiv);
}

// Clear all validation errors
function clearValidationErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.alert-danger').remove();
    $('.alert-success').remove();
}

// Show validation summary
function showValidationSummary() {
    const errorCount = $('.is-invalid').length;
    const summaryHtml = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><i class="fas fa-exclamation-triangle"></i> Validation Errors</h6>
            <p>Please fix ${errorCount} error(s) before submitting:</p>
            <ul class="mb-0">
                ${$('.invalid-feedback').map(function() { 
                    return `<li>${$(this).text()}</li>`;
                }).get().join('')}
            </ul>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    $('#create-digassets .modal-body').prepend(summaryHtml);
}

// Scroll to first error
function scrollToFirstError() {
    const firstError = $('.is-invalid').first();
    if (firstError.length) {
        firstError[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        firstError.focus();
    }
}

// Show loading state during submit
function showSubmitLoading() {
    const submitBtn = $('button[type="submit"]');
    const closeBtn = $('.btn-secondary');
    
    // Store original button text
    submitBtn.data('original-text', submitBtn.html());
    
    // Update button
    submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Processing...').prop('disabled', true);
    closeBtn.prop('disabled', true);
    
    // Disable form
    $('#reqdigassetsForm input, #reqdigassetsForm select, #reqdigassetsForm textarea').prop('disabled', true);
    
    // Add overlay
    const overlay = `
        <div id="submit-overlay" class="position-absolute w-100 h-100" 
             style="top: 0; left: 0; background: rgba(255,255,255,0.8); z-index: 1000;">
            <div class="d-flex justify-content-center align-items-center h-100">
                <div class="text-center">
                    <div class="spinner-border text-info" role="status">
                        <span class="sr-only">Processing...</span>
                    </div>
                    <p class="mt-2 text-muted">Submitting transfer request...</p>
                </div>
            </div>
        </div>
    `;
    
    $('#create-digassets .modal-content').css('position', 'relative').append(overlay);
}

// Hide loading state
function hideSubmitLoading() {
    const submitBtn = $('button[type="submit"]');
    const closeBtn = $('.btn-secondary');
    
    // Restore button
    submitBtn.html(submitBtn.data('original-text') || '<i class="ti-check"></i> Submit Transfer Request')
             .prop('disabled', false);
    closeBtn.prop('disabled', false);
    
    // Enable form
    $('#reqdigassetsForm input, #reqdigassetsForm select, #reqdigassetsForm textarea').prop('disabled', false);
    
    // Remove overlay
    $('#submit-overlay').remove();
}

// Handle successful submit - IMPROVED VERSION
function handleSubmitSuccess(response) {
    console.log('Handling success:', response); // Debug log
    
    // Check if response is actually successful
    if (response.success === true) {
        // Clear any existing alerts
        $('.alert').remove();
        
        // Show success message
        showSuccessAlert(response.message || 'Transfer request submitted successfully!');
        
        // Disable form after success to prevent resubmission
        $('#reqdigassetsForm input, #reqdigassetsForm select, #reqdigassetsForm textarea').prop('disabled', true);
        $('button[type="button"]').prop('disabled', true);
        
        // Show success actions after a brief delay
        setTimeout(() => {
            showSuccessWithActions(response);
        }, 1500);
        
    } else {
        // Handle cases where success is false
        console.warn('Success is false:', response);
        if (response.errors) {
            handleValidationErrors(response.errors);
        } else {
            showErrorAlert(response.message || 'An error occurred while submitting the form');
        }
    }
}

// Show success alert with action buttons - IMPROVED
function showSuccessWithActions(response) {
    const transferId = response.data?.id || 'N/A';
    const transferRef = response.data?.transfer_ref || 'N/A';
    
    const actionsHtml = `
        <div class="alert alert-success border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-check-circle text-success me-2" style="font-size: 2rem;"></i>
                <div>
                    <h5 class="mb-1 text-success">Transfer Request Submitted!</h5>
                    <p class="mb-1">${response.message || 'Your transfer request has been submitted successfully.'}</p>
                    <small class="text-muted">Transfer ID: ${transferId} | Reference: ${transferRef}</small>
                </div>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="${response.view_url || response.redirect_url}" class="btn btn-success">
                    <i class="fas fa-eye"></i> View Transfer Request
                </a>
                <button type="button" class="btn btn-outline-primary" onclick="window.location.reload()">
                    <i class="fas fa-plus"></i> Create New Transfer
                </button>
                <button type="button" class="btn btn-outline-secondary" onclick="closeModalAndRefresh()">
                    <i class="fas fa-arrow-left"></i> Back to Dashboard
                </button>
            </div>
        </div>
    `;
    
    // Replace modal content with success message
    $('#create-digassets .modal-body').html(actionsHtml);
    
    // Update modal title
    $('#create-digassets .modal-title').html('<i class="fas fa-check-circle text-success"></i> Success');
    
    // Update modal footer
    $('#create-digassets .modal-footer').html(`
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="closeModalAndRefresh()">Close</button>
    `);
}

// Handle submit errors - IMPROVED
function handleSubmitError(xhr) {
    console.error('Submit error details:', {
        status: xhr.status,
        statusText: xhr.statusText,
        responseText: xhr.responseText,
        responseJSON: xhr.responseJSON
    });
    
    if (xhr.status === 422) {
        // Validation errors
        const errors = xhr.responseJSON?.errors || {};
        handleValidationErrors(errors);
    } else if (xhr.status === 403) {
        showErrorAlert('You do not have permission to perform this action');
    } else if (xhr.status === 500) {
        showErrorAlert('Server error occurred. Please try again later');
    } else if (xhr.status === 0) {
        showErrorAlert('Network error. Please check your internet connection');
    } else {
        const errorMessage = xhr.responseJSON?.message || 'An unexpected error occurred. Please try again';
        showErrorAlert(errorMessage);
    }
}

// Handle validation errors from server
function handleValidationErrors(errors) {
    Object.keys(errors).forEach(fieldName => {
        const field = $(`[name="${fieldName}"]`);
        if (field.length) {
            markFieldInvalid(field[0], errors[fieldName][0]);
        }
    });
    
    showValidationSummary();
    scrollToFirstError();
}

// Show success alert - IMPROVED
function showSuccessAlert(message) {
    const alertHtml = `
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-check-circle text-success me-3" style="font-size: 1.5rem;"></i>
                <div class="flex-grow-1">
                    <h6 class="mb-1 text-success">Success!</h6>
                    <p class="mb-0">${message}</p>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing alerts and add success alert at the top
    $('.alert').remove();
    $('#create-digassets .modal-body').prepend(alertHtml);
    
    // Scroll to top to show the success message
    $('#create-digassets .modal-body').scrollTop(0);
}

// Show error alert
function showErrorAlert(message) {
    const alertHtml = `
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-exclamation-circle text-danger me-3" style="font-size: 1.5rem;"></i>
                <div class="flex-grow-1">
                    <h6 class="mb-1 text-danger">Error!</h6>
                    <p class="mb-0">${message}</p>
                </div>
            </div>
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    `;
    
    $('.alert').remove();
    $('#create-digassets .modal-body').prepend(alertHtml);
    $('#create-digassets .modal-body').scrollTop(0);
}

// Close modal and refresh page
function closeModalAndRefresh() {
    $('#create-digassets').modal('hide');
    
    // Small delay to ensure modal is closed before refresh
    setTimeout(() => {
        window.location.reload();
    }, 300);
}

// Close modal function
function closeModal() {
    $('#create-digassets').modal('hide');
}

// Auto-sync quantities
$(document).on('input', '#quantity-from', function() {
    $('#quantity_to').val($(this).val());
});

// Auto-fill effective date when transfer date changes
$(document).on('change', '#date-of-transfer', function() {
    const effectiveDate = $('#effective-date');
    if (!effectiveDate.val()) {
        effectiveDate.val($(this).val());
    }
});

// Real-time validation for specific fields
$(document).on('blur', '#asset-tag-number', function() {
    const value = $(this).val();
    if (value && !/^[A-Z0-9]{6,}$/.test(value)) {
        markFieldInvalid(this, 'Asset tag must be at least 6 characters (letters and numbers only)');
    } else {
        $(this).removeClass('is-invalid').next('.invalid-feedback').remove();
    }
});

// Prevent form submission on Enter key (except in textareas)
$(document).on('keypress', '#reqdigassetsForm input', function(e) {
    if (e.which === 13) {
        e.preventDefault();
        return false;
    }
});

// Alternative approach using async/await (ES6+)
// async function loadFormDataAsync(href) {
//     try {
//         showLoadingState();
        
//         const response = await fetch(href, {
//             method: 'GET',
//             headers: {
//                 'Accept': 'application/json',
//                 'X-Requested-With': 'XMLHttpRequest'
//             }
//         });
        
//         const data = await response.json();
        
//         hideLoadingState();
        
//         if(response.ok && data.success) {
//             populateForm(data.data);
//         } else {
//             throw new Error(data.message || 'Failed to load data');
//         }
        
//     } catch (error) {
//         hideLoadingState();
//         console.error('Error loading data:', error);
//         showAlert('error', error.message || 'Failed to load data. Please try again.');
//     }
// }




})
</script>
@endpush