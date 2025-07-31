@extends('layouts.app_custom')
@section('title-head','Request Dar')
@role('user-employee')
  @section('title','Request Dar')
@endrole
@role('admin')
   @section('title','All Request Dar')
@endrole

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/daterangepicker.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('bootstrap5/css/bootstrap-datetimepicker.min.css') }}">
{{-- <style> --}}

@endsection
@section('content')

@role('user-employee')
<section class="section">
	<div class="section-header">
		@permission('create-reqdar')
		<a href="#" class="btn btn-icon icon-left btn-primary" id="show-create-dar"><i class="fas fa-plus"></i> Add request</a>
		@endpermission
		<div class="section-header-breadcrumb">
			<div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
			<div class="breadcrumb-item"><a href="#">Request Dar</a></div>
			{{-- <div class="breadcrumb-item">DataTables</div> --}}
		</div>
	</div>

	<div class="section-body">
           <div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h4>Filter</h4>
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
												<input type="text" placeholder="Select date range" class="form-control daterange-picker" name="date_range" id="date_range">
											</div>
										</div>
									</div>
                                    <div class="col-md-4">
										<div class="form-group">
											<label>Request Type</label>
											<select class="form-control" name="reqtype" id="reqtype">
												<option value="">All Request Types</option>
												@foreach ($reqTypes as $types )
                                                   <option value="{{ $types->id }}">{{ $types->request_type }}</option>
                                                @endforeach
											</select>
										</div>
									</div>
                                    <div class="col-md-4">
										<div class="form-group">
											<label>Status</label>
											<select class="form-control select2" name="status" id="status">
												<option value="">All Statuses</option>
												<option value="1">Open</option>
												<option value="2">Close</option>
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
                                        <th class="text-center">Details</th>
										<th>No.</th>
										<th class="text-center">Date</th>
								        <th class="text-center">NIK/Nama</th>
                                        <th class="text-center">Name Doc</th>
                                        <th class="text-center">Status</th>
                                        {{-- <th class="text-center">Company</th>
                                        <th class="text-center">Request Type</th> --}} 
                                        {{-- <th class="text-center">ApprovalBy1</th>
                                        <th class="text-center">ApprovalBy2</th>
                                        <th class="text-center">ApprovalBy3</th> --}}
										<th class="text-center"">Action</th>
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
    @endrole

@endsection
@push('js')
@include('request-dar.user-dashboard.create')
@include('request-dar.user-dashboard.show')
@include('request-dar.user-dashboard.edit')
@include('request-dar.user-dashboard.view-docs.view-docs-edit')
@include('request-dar.user-dashboard.view-docs.view-docs-view')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/moment.min.js') }}"></script>
<script src="{{ asset('bootstrap5/js/daterangepicker.min.js') }}"></script>
<script>
$(document).ready(function(){
       	$('.daterange-picker').daterangepicker({
			locale: {format: 'YYYY-MM-DD'},
			drops: 'down',
			opens: 'right',
			autoUpdateInput: false,
		});

		$('.daterange-picker').on('apply.daterangepicker', function(ev, picker) {
			$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
		});

		$('.daterange-picker').on('cancel.daterangepicker', function(ev, picker) {
			$(this).val('');
		});
        // $('.addrm').prop('disabled', true);
        function format(d) {
            return '<div class="row-details-container" style="padding: 20px; background-color: #f8f9fa; margin: 10px 0;">' +
                '<div class="row">' +
                    '<div class="col-md-6">' +
                        '<table class="table table-sm table-borderless">' +
                            '<tr><td><strong>NIK/Name:</strong></td><td>' + (d.nik_req || '-') + '</td></tr>' +
                            '<tr><td><strong>Position:</strong></td><td>' + (d.position || '-') + '</td></tr>' +
                            '<tr><td><strong>Department:</strong></td><td>' + (d.department || '-') + '</td></tr>' +
                            '<tr><td><strong>Request Type:</strong></td><td>' + (d.reqtype || '-') + '</td></tr>' +
                            '<tr><td><strong>Document Name:</strong></td><td>' + (d.name_doc || '-') + '</td></tr>' +
                            '<tr><td><strong>Rev No Before:</strong></td><td>' + (d.rev_no_before || '-') + '</td></tr>' +
                            '<tr><td><strong>Approval 1 (Dept head):</strong></td><td>' + (d.approval_status1 || '-') + '</td></tr>' +
                            '<tr><td><strong>Approval 2 (Syd&IT):</strong></td><td>' + (d.approval_status2 || '-') + '</td></tr>' +
                            '<tr><td><strong>Approval 3 (DeptHead Syd&IT):</strong></td><td>' + (d.approval_status3 || '-') + '</td></tr>' +
                        '</table>' +
                    '</div>' +
                    '<div class="col-md-6">' +
                        '<table class="table table-sm table-borderless">' +
                            '<tr><td><strong>No Doc:</strong></td><td>' + (d.no_doc || '-') + '</td></tr>' +
                            '<tr><td><strong>DAR Number:</strong></td><td>' + (d.number_dar || '-') + '</td></tr>' +
                            '<tr><td><strong>Storage Type:</strong></td><td>' + (d.storage_type || '-') + '</td></tr>' +
                            '<tr><td><strong>Pages:</strong></td><td>' + (d.storage_type || '-') + '</td></tr>' +
                            '<tr><td><strong>Reason:</strong></td><td>' + (d.reason || '-') + '</td></tr>' +
                            '<tr><td><strong>Rev No After:</strong></td><td>' + (d.rev_no_after || '-') + '</td></tr>' +
                            '<tr><td><strong>Status Transaction:</strong></td><td>' + (d.status || '-') + '</td></tr>' +
                        '</table>' +
                    '</div>' +
                '</div>' +
            '</div>';
        }
		var table = $('#table-request-manage').DataTable({
			   "columnDefs": [{
                "searchable": false,
                "orderable": false,
                "targets": 0,
                "className": 'details-control',
                "defaultContent": '',
                "width": "30px"
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 1,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
            }],
			processing: true,
			serverSide: true,
			deferRender:true,
			ajax: {
				url: "{{ route('requestdar.index') }}",
                data: function(d){
                    // Get filter values
                    var dateRange = $('#date_range').val();
                    var reqType = $('#reqtype').val();
                    var status = $('#status').val();

                    // Add filter values to the request data
                    d.date_range = dateRange;
                    d.reqtype = reqType;
                    d.status = status;
                }
			},
			order: [[ 1, 'desc']],
			responsive: false,
            // scrollX: false,
			columns: [
            {
                "className": 'details-control',
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": '',
                "width": "30px"
            },
			{
				data: null,
				name: null,
				orderable: false,
				searchable: false,
				className: 'text-center',
                width:'50px'
			},
			{ data: 'created_date', name: 'created_date', className: 'text-center' },
			{ data: 'nik_req', name: 'nik_req', className:'text-center' },
            // { data: 'position', name: 'position',className: 'text-center' },
            // { data: 'department', name: 'department',className: 'text-center' },
            // { data: 'position', name: 'position',className: 'text-center' },
            { data: 'name_doc', name: 'name_doc',className: 'text-center' },
            { data: 'status', name: 'status',className: 'text-center' },
            // { data: 'approval_status2', name: 'approval_status2',className: 'text-center' },
            // { data: 'approval_status3', name: 'approval_status3',className: 'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
});
$('#table-request-manage tbody').on('click', 'td.details-control', function () {
        var tr = $(this).closest('tr');
        var row = table.row(tr);
 
        if (row.child.isShown()) {
            // This row is already open - close it
            row.child.hide();
            tr.removeClass('shown');
        } else {
            // Open this row
            row.child(format(row.data())).show();
            tr.addClass('shown');
        }
    });
     table.on('responsive-display', function (e, datatable, row, showHide, update) {
        if (showHide) {
            row.child(format(row.data())).show();
        }
    });
  $('#btn-filter').click(function() {
		table.ajax.reload();
	});
$(document).on('click','#show-create-dar', function(e){
        e.preventDefault();
        resetForm();
        $('#create-reqdar').modal('show');
    })
    $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').on('change keyup', function() {
        validateForm();
    });

    // Radio button change handler
    $('#reqdarForm input[type="radio"]').on('change', function() {
        validateForm();
    });
     $('input[name="request_desc_id"]').on('change', function() {
        handleDescriptionChange();
        validateForm();
    });
    function handleDescriptionChange() {
    var selectedDesc = $('input[name="request_desc_id"]:checked');
    var revNoContainer = $('#rev_no_before, #rev_no_after').closest('.col-md-3');
    
    if (selectedDesc.length > 0) {
        // Get the label text of selected description
        var descText = selectedDesc.next('label').text().toLowerCase();
        
        if (descText.includes('new issue') || descText.includes('new')) {
            // Hide Rev No fields
            revNoContainer.hide();
            $('#rev_no_before').removeAttr('required').val('');
            $('#rev_no_after').val('');
        } else {
            revNoContainer.show();
            $('#rev_no_before').attr('required', true);
        }
    } else {
        // If no description selected, show Rev No fields but don't make them required yet
        revNoContainer.show();
        $('#rev_no_before').removeAttr('required');
    }
}
    // validasi file_doc
    $('#file_doc').on('change', function() {
        var fileInput = this;
        var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih file PDF atau Excel';
        $(this).next('.custom-file-label').text(fileName);

        // Validate file type and size
        if (fileInput.files.length > 0) {
            var file = fileInput.files[0];
            
            // Allowed file types
                var allowedTypes = [
                    'application/pdf',
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
                    'application/vnd.ms-excel' // .xls
                ];
                
                // Get file extension
                var fileExtension = file.name.split('.').pop().toLowerCase();
                var allowedExtensions = ['pdf', 'xlsx', 'xls'];

                // Check file type using MIME type and extension
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    showNotification('error', 'Hanya file PDF dan Excel (.xlsx, .xls) yang diperbolehkan');
                    $(this).val(''); // Clear file input
                    $(this).next('.custom-file-label').text('Pilih file PDF atau Excel');
                    return false;
                }

            
                // Check file size (max 10MB for Excel, 5MB for PDF)
                var maxSize = fileExtension === 'pdf' ? 5 * 1024 * 1024 : 10 * 1024 * 1024; // 5MB for PDF, 10MB for Excel
                var maxSizeText = fileExtension === 'pdf' ? '5MB' : '10MB';
                
                if (file.size > maxSize) {
                    showNotification('error', 'Ukuran file maksimal ' + maxSizeText);
                    $(this).val(''); // Clear file input
                    $(this).next('.custom-file-label').text('Pilih file PDF atau Excel');
                    return false;
                }

                // Show success message for valid file
                var fileType = fileExtension === 'pdf' ? 'PDF' : 'Excel';
                // showNotification('success', 'File ' + fileType + ' berhasil dipilih: ' + fileName);
            }


        // Re-validate the form
        validateForm();
    });

    function validateForm() {
        var isValid = true;

        // Check if request type is selected
        if ($('input[name="typereqform_id"]:checked').length === 0) {
            isValid = false;
        }


        if ($('input[name="request_desc_id"]:checked').length === 0) {
            isValid = false;
        }


        // Check required text inputs and textareas
        $('#reqdarForm input[type="text"], #reqdarForm input[type="number"], #reqdarForm textarea').each(function() {
            if ($(this).prop('required') && !$(this).val().trim()) {
                isValid = false;
                return false; // break the loop
            }
        });

        // Check if a storage type is selected
        if ($('input[name="storage_type"]:checked').length === 0) {
            isValid = false;
        }

        // Check specific fields
        if (!$('#name-doc').val().trim() ||
            !$('#no-doc').val().trim() ||
            !$('#qty-pages').val() ||
            !$('#reason').val().trim() ||
            !$('#rev_no_before').val()) {
            isValid = false;
        }

        if ($('#rev_no_before').is(':visible') && $('#rev_no_before').prop('required') && !$('#rev_no_before').val()) {
            isValid = false;
        }

                // Check file input
        if ($('#file_doc').prop('required') && $('#file_doc').val() === '') {
            isValid = false;
        }


        // Enable or disable submit button based on validation

        $('.addrm').prop('disabled', !isValid);
        // alert(isValid);
        return isValid;
    }
     // Reset form function
     function resetForm() {
       $('#reqdarForm')[0].reset();
        $('input[name="typereqform_id"]').prop('checked', false);
        $('input[name="storage_type"]').prop('checked', false);
        $('input[name="request_desc_id"]').prop('checked', false);
        $('.custom-file-label').text('Pilih file PDF/Excel');
        $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').prop('disabled', false);
    }
    function showNotification(type, message) {
        if(type == 'success'){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Successfully',
                text: message,
                showConfirmButton: false,
                timer: 1500
            })
        } else if(type=='warning') {
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: message,
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: message,
            })
        }

    }
    $('.addrm').on('click', function() {
        // console.log(validateForm())
        if (!validateForm()) {
            showNotification('warning', 'Lengkapi semua field yang diperlukan');
            return false;
        }

        // Create FormData object to handle file uploads
        var formData = new FormData($('#reqdarForm')[0]);
        // Submit form via AJAX
        $.ajax({
            url: $('#reqdarForm').attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                $('.addrm').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Submit...');
                 $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    $('#create-reqdar').modal('hide');

                    showNotification('success', response.message);

                    resetForm();
                    $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').prop('disabled', false);

                    if (typeof refreshDataTable === 'function') {
                        refreshDataTable();
                    }

                } else {
                    showNotification('error', response.message);
                     $('.addrm').prop('disabled', false).html('<i class="ti-check"></i> Submit');
                }
                // resetForm()
            },
            error: function(xhr) {
                var errorMessage = 'Terjadi kesalahan saat upload';

                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    errorMessage = '';

                    // Format validation errors
                    $.each(errors, function(key, value) {
                        errorMessage += value + '<br>';
                    });
                }

                showNotification('error', errorMessage);
            },
            complete: function() {
                $('.addrm').prop('disabled', false).html('<i class="ti-check"></i> Submit');
                  $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').prop('disabled', false);
            }
        });
        function refreshDataTable() {
            $('#table-request-manage').DataTable().ajax.reload();
        }
    });

    



})
</script>
@endpush
