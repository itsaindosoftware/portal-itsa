@extends('layouts.app_custom')
@section('title-head','Transfer Asset Notification')
@role('admin')
   @section('title','History Transfer Asset Notification')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/bootstrap-datetimepicker.min.css') }}">
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

.status-badge {
    font-size: 0.875em;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.025em;
}
.status-pending {
    background-color: #fef3c7;
    color: #92400e;
    border: 1px solid #fbbf24;
}
.status-sent {
    background-color: #dbeafe;
    color: #1e40af;
    border: 1px solid #3b82f6;
}
.status-completed {
    background-color: #dcfce7;
    color: #166534;
    border: 1px solid #22c55e;
}
.status-cancelled {
    background-color: #fee2e2;
    color: #dc2626;
    border: 1px solid #ef4444;
}

</style>
@endsection
@section('content')
<div class="section-body">
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
									<div class="col-md-4">
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
									 <div class="col-md-4">
										<div class="form-group">
											<label>Company</label>
											<select class="form-control" name="company-cp" id="company-cp">
												<option value="">All Company</option>
                                                @foreach ($companys as $cp )
                                                <option value="{{ $cp->id }}">PT{{ $cp->company_desc  }}</option>
                                                @endforeach
												
											</select>
										</div>
									</div>
                                    <div class="col-md-4">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control" name="transfer_status" id="transfer_status">
												<option value="">All Statuses</option>
												<option value="pending">Pending</option>
												<option value="sent">Sent</option>
												<option value="completed">Completed</option>
                                                <option value="cancelled">Cancelled</option>
											</select>
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
                                        <th class="text-center">Production Code</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Requestor Name</th>
                                        <th class="text-center">Company</th>
                                        <th class="text-center">Status</th>
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
{{-- @include('digitalassets.send-notif-transfer.user-dashboard.sendnotif-modal') --}}
@include('digitalassets.send-notif-transfer.user-admin-sendnotif.edit')
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


      $('[data-toggle="tooltip"]').tooltip()

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
                    d.transfer_status = $('#transfer_status').val();
					d.company = $('#company-cp').val();
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
            { data: 'company_name', name: 'company_name',className: 'text-center' },
             { 
                data: 'transfer_status', 
                name: 'transfer_status', 
                className: 'text-center',
                render: function(data, type, row) {
                    if (type === 'display') {
                        let statusClass = 'status-' + data;
                        let statusText = data.charAt(0).toUpperCase() + data.slice(1);
                        return '<span class="status-badge ' + statusClass + '">' + statusText + '</span>';
                    }
                    return data;
                }
            },
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

// Enhanced closeModal function
$(document).on('click','#approval-data', function(e) {
	e.preventDefault();
	var id = $(this).data('id');
	var href = $(this).data('href');
	if (!id|| !href) {
		Swal.fire({
			title: 'Error!',
			text: 'Invalid request data.',
			icon: 'error'
		});
		return;
	}
	var approvalDate5 = $(this).attr('row-approve5');
	var approvalStatus5 = $(this).attr('row-status5');
	// alert(approvalDate5)
	if (approvalDate5 && approvalStatus5 === '1') {
		Swal.fire({
			title: 'Already Approved',
			text: 'This request has already been approved',
			icon: 'info'
		});
		return;
	}
	if (approvalDate5 && approvalStatus5 === '2') {
		Swal.fire({
			title: 'Already Rejected',
			text: 'This request has already been rejected',
			icon: 'info'
		});
		return;
	}


	Swal.fire({
		title: 'Are you sure?',
		text: "You want to approve this request?",
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, approve it!',
		input: 'textarea',
		inputLabel: 'Remarks',
		inputPlaceholder: 'Please enter your remarks here (optional)',
		inputAttributes: {
			'aria-label': 'Remarks',
			'maxlength': 500
		},
		showCancelButton: true,
		cancelButtonText: 'Cancel',
		inputValidator: (value) => {
		}
	}).then((result) => {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if (result.value || result.value == '') {
			let remark = result.value || '-'; // Get remarks value, empty string if nothing entered
			$.ajax({
				url: href,
				type: "POST",
				data: {
					'_method': 'POST',
					'remark': remark // Send remarks to the server
				},
				success: function(data) {
					Swal.fire(
						'Approved!',
						data.message,
						'success'
					);
					// table.ajax.reload();
					$('#table-request-manage').DataTable().ajax.reload();

				},
				error: function(xhr) {
						Swal.fire(
							'Error!',
							xhr.responseJSON.message,
							'error'
						);
				}
			});
		} else {
			console.log(`data was canceled`);
		}
	});

});
$(document).on('click','#reject-data', function(e) {
	e.preventDefault();
	var id = $(this).data('id');
	var href = $(this).data('href');
	if (!id|| !href) {
		Swal.fire({
			title: 'Error!',
			text: 'Invalid request data.',
			icon: 'error'
		});
		return;
	}
	var approvalDate5 = $(this).attr('row-approve5');
	var approvalStatus5 = $(this).attr('row-status5');
	// alert(approvalDate5)
	if (approvalDate5 && approvalStatus5 === '1') {
		Swal.fire({
			title: 'Already Approved',
			text: 'This request has already been approved',
			icon: 'info'
		});
		return;
	}
	if (approvalDate5 && approvalStatus5 === '2') {
		Swal.fire({
			title: 'Already Rejected',
			text: 'This request has already been rejected',
			icon: 'info'
		});
		return;
	}


	Swal.fire({
		title: 'Are you sure?',
		text: "You want to reject this request?",
		icon: 'warning',
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, reject it!',
		input: 'textarea',
		inputLabel: 'Remarks',
		inputPlaceholder: 'Please enter your remarks here (optional)',
		inputAttributes: {
			'aria-label': 'Remarks',
			'maxlength': 500
		},
		showCancelButton: true,
		cancelButtonText: 'Cancel',
		inputValidator: (value) => {
		}
	}).then((result) => {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		if (result.value || result.value == '') {
			let remark = result.value || '-'; // Get remarks value, empty string if nothing entered
			$.ajax({
				url: href,
				type: "POST",
				data: {
					'_method': 'POST',
					'remark': remark // Send remarks to the server
				},
				success: function(data) {
					Swal.fire(
						'Rejected!',
						data.message,
						'success'
					);
					// table.ajax.reload();
					$('#table-request-manage').DataTable().ajax.reload();

				},
				error: function(xhr) {
						Swal.fire(
							'Error!',
							xhr.responseJSON.message,
							'error'
						);
				}
			});
		} else {
			console.log(`data was canceled`);
		}
	});

});

$(document).on('click','#edit-detail-data', function(){
     var href = $(this).data('href');

     $('#edit-send-notif').modal('show');
    $.ajax({
        url: href,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
			// console.log(response)
            if(response.success) {
                // Fill form with data
                populateForm(response.data);
            } else {
                showAlert('error', response.message || 'Failed to load data');
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            showAlert('error', 'Failed to load data. Please try again.');
        }
    });
})

function populateForm(data) {
    // Section 1: Transfer FROM
	if(data.id) $('#id-send-notif').val(data.id);
    if(data.department_id_from) $('#transferring-dept-edit').val(data.department_id_from).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
        $(this).blur();
    });
    if(data.id_cost_center_from) $('#cost-center-from-edit').val(data.id_cost_center_from).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
        $(this).blur();
    });
    if(data.product_name) $('#item-description-edit').val(data.product_name).prop('readonly', true);
    if(data.io_no) $('#io-no-from-edit').val(data.io_no).prop('readonly', true);
    if(data.rfa_number) $('#asset-tag-number-edit').val(data.rfa_number).prop('readonly', true);

    if(data.id_location_from) $('#location-from-edit').val(data.id_location_from).trigger('change').css({
		'pointer-events': 'none',
		'background-color': '#f5f5f5',
        'color': '#666'
	}).on('focus', function() {
        $(this).blur();
    });
    if(data.from_qty) $('#quantity-from-edit').val(data.from_qty).prop('readonly', true);
    if(data.requestor_name) $('#pic-name-from-edit').val(data.requestor_name).prop('readonly', true);
    if(data.date) $('#date-of-transfer-edit').val(data.date).prop('readonly', true);
    if(data.from_io_no) $('#io-no-approval-edit').val(data.from_io_no).prop('readonly', true);;
    if(data.id_dept_to) $('#receiving-dept-edit').val(data.id_dept_to);
    if(data.to_cost_center_id) $('#new-cost-center-edit').val(data.to_cost_center_id);
    if(data.id_loct_to) $('#new-location-edit').val(data.id_loct_to);
    if(data.to_qty) $('#quantity-to-edit').val(data.to_qty)
    if(data.to_pic_name) $('#pic-name-to-edit').val(data.to_pic_name)
    if(data.to_effective_date) $('#effective-date-edit').val(data.to_effective_date)
    if(data.to_tf_fer_no_erp) $('#transfer-ref-no-edit').val(data.to_tf_fer_no_erp)
    let imagePath = data.pic_support.replace('public/', '');
    if(data.pic_support){
       $('#image-preview-edit').attr('src', '/storage/' + imagePath).show();
    } else {
        $('#image-preview-edit').hide();
    }
    
    // if(data.asset_group) $('#asset_group-edit').val(data.asset_group).trigger('change');
    
    // Remove any validation error classes
    $('.is-invalid').removeClass('is-invalid');
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
    $('#edit-send-notif .modal-body').prepend(alertHtml);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        $('.alert').fadeOut();
    }, 5000);
}
$(document).on('click','#edit-transfer', function(e){
    e.preventDefault()
    // showAlert('success', 'successfully')
    let id = $('#id-send-notif').val();
    
    // Validate required fields
    if(!validateEditForm()) {
        return false;
    }
    
    // Show loading state
    $('#edit-transfer').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');
    
    // Prepare form data
    let formData = new FormData();
    
    // Add all form fields
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
    formData.append('_method', 'PUT');
    formData.append('id', id);
    
    // Transfer FROM data
    formData.append('department_id_from', $('#transferring-dept-edit').val());
    formData.append('id_cost_center_from', $('#cost-center-from-edit').val());
    formData.append('io_no', $('#io-no-from-edit').val());
    formData.append('id_location_from', $('#location-from-edit').val());
    formData.append('date', $('#date-of-transfer-edit').val());
    formData.append('from_io_no', $('#io-no-approval-edit').val());
    
    // Transfer TO data
    formData.append('id_dept_to', $('#receiving-dept-edit').val());
    formData.append('to_cost_center_id', $('#new-cost-center-edit').val());
    formData.append('id_loct_to', $('#new-location-edit').val());
    formData.append('to_qty', $('#quantity-to-edit').val());
    formData.append('to_pic_name', $('#pic-name-to-edit').val());
    formData.append('to_effective_date', $('#effective-date-edit').val());
    formData.append('to_tf_fer_no_erp', $('#transfer-ref-no-edit').val());
    
    // Handle file upload if new file is selected
    let fileInput = $('#pic-support-edit')[0];
    if(fileInput && fileInput.files && fileInput.files[0]) {
        formData.append('pic_support', fileInput.files[0]);
    }
    var route =  "{{ route('transfernotif.update',':id') }}";
    var route = route.replace(':id', window.btoa(id));
    $.ajax({
        url: route, // Adjust URL sesuai route Anda
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                Swal.fire(
						'Successfully',
						response.message,
						'success'
					);
                
                // Refresh DataTable if exists
                if(typeof table !== 'undefined' && table.ajax) {
                    $('#table-request-manage').DataTable().ajax.reload()
                }
                
                // Close modal after delay
                setTimeout(() => {
                    $('#edit-send-notif').modal('hide');
                    resetEditForm();
                }, 2000);
                
            } else {
                // showAlert('error', response.message || 'Failed to update transfer');
                Swal.fire(
						'Failed to update transfer!',
						response.message,
						'error'
					);
            }
        },
        error: function(xhr, status, error) {
            console.error('Update Error:', xhr.responseText);
            
            if(xhr.status === 422) {
                // Handle validation errors
                let errors = xhr.responseJSON.errors;
                handleValidationErrors(errors);
            } else {
                // showAlert('error', 'Failed to update transfer. Please try again.');
                  Swal.fire(
						 'Failed to update transfer. Please try again.',
						response.message,
						'error'
					);
            }
        },
        complete: function() {
            // Reset button state
            $('#edit-transfer').prop('disabled', false).html('Update Transfer');
        }
    });
});
// Validation function for edit form
function validateEditForm() {
    let isValid = true;
    
    // Clear previous validation states
    $('.is-invalid').removeClass('is-invalid');
    
    // Required fields validation
    const requiredFields = [
        '#transferring-dept-edit',
        '#cost-center-from-edit',
        '#receiving-dept-edit',
        '#new-cost-center-edit',
        '#new-location-edit',
        '#quantity-to-edit',
        '#pic-name-to-edit',
        '#effective-date-edit'
    ];
    
    requiredFields.forEach(field => {
        if(!$(field).val() || $(field).val().trim() === '') {
            $(field).addClass('is-invalid');
            isValid = false;
        }
    });
    
    // Quantity validation
    let toQty = parseFloat($('#quantity-to-edit').val());
    let fromQty = parseFloat($('#quantity-from-edit').val());
    
    if(toQty <= 0) {
        $('#quantity-to-edit').addClass('is-invalid');
        showAlert('error', 'Quantity must be greater than 0');
        
        isValid = false;
    }
    
    if(toQty > fromQty) {
        $('#quantity-to-edit').addClass('is-invalid');
        showAlert('error', 'Transfer quantity cannot exceed available quantity');
        isValid = false;
    }
    
    // Date validation
    let transferDate = new Date($('#date-of-transfer-edit').val());
    let effectiveDate = new Date($('#effective-date-edit').val());
    
    if(effectiveDate < transferDate) {
        $('#effective-date-edit').addClass('is-invalid');
        showAlert('error', 'Effective date cannot be earlier than transfer date');
        isValid = false;
    }
    
    if(!isValid) {
        showAlert('error', 'Please fill all required fields correctly');
    }
    
    return isValid;
}

// Handle validation errors from server
function handleValidationErrors(errors) {
    Object.keys(errors).forEach(field => {
        let fieldElement = $(`#${field.replace('_', '-')}-edit`);
        if(fieldElement.length) {
            fieldElement.addClass('is-invalid');
        }
    });
    
    // Show first error message
    let firstError = Object.values(errors)[0];
    if(firstError && firstError[0]) {
        showAlert('error', firstError[0]);
    }
}
function resetEditForm() {
    $('#edit-send-notif form')[0].reset();
    $('.is-invalid').removeClass('is-invalid');
    $('#image-preview-edit').hide();
    
    // Reset select2 if used
    $('.select2').val(null).trigger('change');
}

// File input change handler for edit form
$(document).on('change', '#pic-support-edit', function() {
    let file = this.files[0];
    if(file) {
        // Validate file type
        let allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
        if(!allowedTypes.includes(file.type)) {
            showAlert('error', 'Please select a valid image file (JPEG, PNG, GIF)');
            $(this).val('');
            return;
        }
        
        // Validate file size (5MB max)
        if(file.size > 5 * 1024 * 1024) {
            showAlert('error', 'File size must be less than 5MB');
            $(this).val('');
            return;
        }
        
        // Preview image
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#image-preview-edit').attr('src', e.target.result).show();
        }
        reader.readAsDataURL(file);
    }
});

// Modal close event
$('#edit-send-notif').on('hidden.bs.modal', function() {
    resetEditForm();
});
$(document).on('click','#delete-detail-data', function(e){
    e.preventDefault();
    
    var id = $(this).data('id');
    var rfaNumber = $(this).data('rfa') || 'this item'; // Optional: untuk menampilkan RFA number
    
    // Validasi ID
    if(!id) {
        Swal.fire(
            'Error!',
            'Invalid data ID',
            'error'
        );
        return;
    }
    
    // Konfirmasi delete dengan SweetAlert2
    Swal.fire({
        title: 'Are you sure?',
        text: `You want to delete transfer notification for ${rfaNumber}? This action cannot be undone!`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        reverseButtons: true,
        focusCancel: true
    }).then((result) => {
        if (result.isConfirmed) {
            // Show loading
            Swal.fire({
                title: 'Deleting...',
                text: 'Please wait while we delete the data',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            
            // Perform delete request
            performDelete(id);
        }
    });
});

function performDelete(id) {

    var route = "{{ route('transfernotif.destroy', ':id') }}";
    var route = route.replace(':id', window.btoa(id)); 
    
    $.ajax({
        url: route,
        type: 'POST', 
        data: {
            '_token': $('meta[name="csrf-token"]').attr('content'),
            '_method': 'DELETE' 
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.success) {
                // Success notification
                Swal.fire(
                    'Deleted!',
                    response.message || 'Transfer notification has been deleted successfully.',
                    'success'
                ).then(() => {
                    // Refresh DataTable
                    if(typeof table !== 'undefined' && table.ajax) {
                        $('#table-request-manage').DataTable().ajax.reload();
                    } else {

                        location.reload();
                    }
                });
            } else {
                // Server returned success:false
                Swal.fire(
                    'Error!',
                    response.message || 'Failed to delete the data.',
                    'error'
                );
            }
        },
        error: function(xhr, status, error) {
            console.error('Delete Error:', xhr.responseText);
            
            let errorMessage = 'Failed to delete the data. Please try again.';
            
            // Handle different error status codes
            if(xhr.status === 403) {
                errorMessage = 'You do not have permission to delete this data.';
            } else if(xhr.status === 404) {
                errorMessage = 'Data not found or already deleted.';
            } else if(xhr.status === 422) {
                // Validation error
                let errors = xhr.responseJSON?.errors || {};
                errorMessage = Object.values(errors)[0] || errorMessage;
            } else if(xhr.responseJSON?.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            Swal.fire(
                'Error!',
                errorMessage,
                'error'
            );
        }
    });
}


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