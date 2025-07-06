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
								        <th class="text-center">NIK/Nama</th>
                                        <th class="text-center">Position</th>
                                        <th class="text-center">Department</th>
                                        <th class="text-center">Company</th>
                                        <th class="text-center">Request Type</th>
                                        <th class="text-center">ApprovalBy1</th>
                                        <th class="text-center">ApprovalBy2</th>
                                        <th class="text-center">ApprovalBy3</th>
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
<script>
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
				url: "{{ route('requestdar.index') }}",
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
			{ data: 'created_date', name: 'created_date', className: 'text-center' },
			{ data: 'nik_req', name: 'nik_req', className:'text-center' },
            { data: 'position', name: 'position',className: 'text-center' },
            { data: 'department', name: 'department',className: 'text-center' },
            { data: 'position', name: 'position',className: 'text-center' },
            { data: 'reqtype', name: 'reqtype',className: 'text-center' },
            { data: 'approval_status1', name: 'approval_status1',className: 'text-center' },
            { data: 'approval_status2', name: 'approval_status2',className: 'text-center' },
            { data: 'approval_status3', name: 'approval_status3',className: 'text-center' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
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
        if (!$('#dept-id').val() ||
            !$('#name-doc').val().trim() ||
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
