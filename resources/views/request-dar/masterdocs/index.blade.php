@extends('layouts.app_custom')
@section('title-head','Master Documents')

  @section('title','Master Documents')


@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">

</style>
@endsection
@section('content')

{{-- @role('user-employee') --}}

<section class="section">
    @permission('create-masterdocs')
	<div class="card-header">
		<button type="button" class="btn btn-icon icon-left btn-primary" id="show-create-masterdocs"><i class="fas fa-plus"></i> Add Documents </button>
	</div>
     @endpermission
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
									<div class="col-md-3">
										<div class="form-group">
											<label>Type Documents</label>
											<select class="form-control select2" name="type_docs" id="type_docs">
												<option value="">All Docs</option>
												<option value="procedure">Procedure</option>
												<option value="workinstruction">Work Instruction</option>
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
						<div class="alert alert-info alert-dismissible show fade">
	                      <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
	                      <div class="alert-body">
	                        <div class="alert-title">Success</div>
	                        {{ session()->get('success') }}
	                        </div>
	                         <button class="close" data-dismiss="alert">
	                          {{-- <span>X</span> --}}
	                        </button>
	                    </div>
	                     @endif
                         {{-- <a href="#" class="btn btn-icon icon-left btn-primary" id="show-create-masterdocs"><i class="fas fa-plus"></i> Add Documents </a> --}}
						<div class="table-responsive">
                            
							<table class="table table-bordered dataTable no-footer" id="table-master-manage" width="100%" role="grid" aria-describedby="table-1_info">
								<thead>
									<tr>
										<th width="7%">No.</th>
										<th class="text-center">Title</th>
								        {{-- <th class="text-center">Description</th> --}}
                                        <th class="text-center">Type Document</th>
                                        <th class="text-center">Documents File</th>
										<th class="text-center" width="10%">Action</th>
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
@include('request-dar.masterdocs.create')
@include('request-dar.masterdocs.edit')
@include('request-dar.masterdocs.show')
@include('request-dar.masterdocs.view-docs.view-docs-edit')
@include('request-dar.masterdocs.view-docs.view-docs-view')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function(){
        // $('.addrm').prop('disabled', true);

		var table = $('#table-master-manage').DataTable({
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
				url: "{{ route('masterdocs.index') }}",
                data: function(d) {
                    d.type_docs = $('#type_docs').val();
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
			{ data: 'title', name: 'title', className: 'text-left' },
			//{ data: 'description', name: 'description', className:'text-center' },
            { data: 'type_doc', name: 'type_doc',className: 'text-center' },
            { data: 'file', name: 'file',className: 'text-left' },
			{ data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
			]
	//
      });
        $(document).on('click','#show-create-masterdocs', function(){
            // e.preventDefault();
            $('#add-documents-master').modal('show');
                // validateForm()

            $('#documentsForm input, #documentsForm textarea, #documentsForm select').on('change keyup', function() {
                validateForm();
            });

        })

    $('.submitdocs').on('click', function() {
        // console.log(validateForm())
        if (!validateForm()) {
            showNotification('warning', 'Lengkapi semua field yang diperlukan');
            return false;
        }

        // Create FormData object to handle file uploads
        var formData = new FormData($('#documentsForm')[0]);
        // Submit form via AJAX
        $.ajax({
            url: $('#documentsForm').attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function() {
                 $('.submitdocs').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> loading...');
                 $('#documentsForm input, #documentsForm textarea, #documentsForm select').prop('disabled', true);
            },
            success: function(response) {
                if (response.success) {
                    $('#create-reqdar').modal('hide');

                    showNotification('success', response.message);

                    // resetForm();
                    $('#documentsForm input, #documentsForm textarea, #documentsForm select').prop('disabled', false);

                    

                } else {
                    showNotification('error', response.message);
                     $('.submitdocs').prop('disabled', false).html('<i class="ti-check"></i> Submit');
                }
                resetForm()
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
                $('.submitdocs').prop('disabled', false).html('<i class="ti-check"></i> Submit');
                  $('#documentsForm input, #documentsForm textarea, #documentsForm select').prop('disabled', false);
            }
        });

    function resetForm() {
        $('#add-documents-master').modal('hide');
        if (typeof refreshDataTable === 'function') {
            table.DataTable().ajax.reload(null, false);

        }
        $('#documentsForm')[0].reset();
        $('.custom-file-label').text('Pilih file PDF/Excel');
        $('#documentsForm input, #documentsForm textarea, #documentsForm select').prop('disabled', false);
    }
 

});
    $(document).on('click','#show-data-masterdocs', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let route = "{{ route('masterdocs.show', ':id') }}";
        let url = route.replace(':id', window.btoa(id))
        // alert(id)

          $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // console.log(response)
                $('#view-document-modal').modal('show');
                $('#id-view-docs').val(response.id)
                $('#view_document_').html(response.title);
                $('#view_description').html(response.description);
                $('#view_type_badge').html(response.type_doc)
                $('#file-storage-view').val(response.file);
                if (response.file) {
                    const fileName = response.file.split('/').pop();
                    $('#view_file_name').text(fileName);
                    $('#view_file_btn').data('document-id', response.id);
                    $('#view_file_btn').prop('disabled', false);
                    const downloadUrl = `${window.location.origin}/download-document-master/${response.id}`;
                    $('#download_file_btn_view').attr('href', downloadUrl);
                } else {
                    $('#view_file_name').text('No file attached');
                    $('#view_file_btn').prop('disabled', true);
                    $('#download_file_btn_view').attr('href', '#');
                }

            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error fetching Master Docs details:', error);
                alert('Failed to load request details. Please try again.');
            }
        })
    })
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
     function validateForm() {
        var isValid = true;

        // Check required text inputs and textareas
        $('#documentsForm input[type="text"], #documentsForm input[type="number"], #documentsForm textarea').each(function() {
            if ($(this).prop('required') && !$(this).val().trim()) {
                isValid = false;
                return false; // break the loop
            }
        });

        // Check specific fields
        if (!$('#title').val() ||
            !$('#description').val().trim() ||
            !$('#type-docs').val().trim() ) {
            isValid = false;
        }
                // Check file input
        if ($('#file_doc').prop('required') && $('#file_doc').val() === '') {
            isValid = false;
        }


        // Enable or disable submit button based on validation

        $('.submitdocs').prop('disabled', !isValid);
        // alert(isValid);
        return isValid;
    }
    $(document).on('click','#edit-data-masterdocs', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let route = "{{ route('masterdocs.edit', ':id') }}";
        let url = route.replace(':id', window.btoa(id))
        // alert(id)

          $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                // console.log(response)
                $('#edit-documents-master').modal('show');
                $('#edit_document_id').val(response.id)
                $('#edit_title').val(response.title);
                $('#edit_description').val(response.description);
                $('#edit_type_docs').val(response.type_doc).trigger('change');
                $('#file-storage-edit').val(response.file);
                if (response.file) {
                        const fileName = response.file.split('/').pop();
                        $('#current_file_name').val(fileName);
                        $('#pdf-file-name').text(fileName);
                        // $('#file-doc-path').val(response.file);

                        // Enable tombol view PDF dan set document ID
                        $('#view_current_file').data('document-id', response.id);
                        $('#view_current_file').prop('disabled', false);
                        // updateViewButton(fileName);
                } else {
                    $('#pdf-file-name').text('Tidak ada file');
                    $('#view_current_file').prop('disabled', true);
                }

            },
            error: function(xhr, status, error) {
                // Handle error
                console.error('Error fetching Master Docs details:', error);
                alert('Failed to load request details. Please try again.');
            }
        })
    })
      $(document).on('click', '#view_current_file', function() {
        const documentId = $(this).data('document-id');
        // alert(documentId)
        let urlFiledoc = $('#file-storage-edit').val();
        // alert(urlFiledoc)

        // alert(urlFiledoc)
        if (documentId  && urlFiledoc ) {
            // Set URL dan tampilkan modal
            const fileExtension = urlFiledoc.split('.').pop().toLowerCase();
            const excelExtensions = ['xlsx', 'xls', 'xlsm', 'xlsb', 'csv'];

            if (excelExtensions.includes(fileExtension)) {
                const downloadUrl = `${window.location.origin}/download-document-master/${documentId}`;
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else if(fileExtension == 'pdf'){
                const pdfUrl = `${window.location.origin}/view-document-master/${documentId}`;
                // alert(pdfUrl)
                $('#pdf-viewer-iframe').attr('src', pdfUrl);

                const downloadUrl = `${window.location.origin}/download-document-master/${documentId}`;
                $('#download-pdf-btn').attr('href', downloadUrl);
                $('#pdf-viewer-modal-edit').modal('show');
            }


        } else {
            alert('Tidak ada dokumen PDF/Excel yang tersedia');
        }
    });
      $(document).on('click', '#view_file_btn', function() {
        const documentId = $(this).data('document-id');
        // alert(documentId)
        let urlFiledoc = $('#file-storage-view').val();
        // alert(urlFiledoc)

        // alert(urlFiledoc)
        if (documentId  && urlFiledoc ) {
            // Set URL dan tampilkan modal
            const fileExtension = urlFiledoc.split('.').pop().toLowerCase();
            const excelExtensions = ['xlsx', 'xls', 'xlsm', 'xlsb', 'csv'];

            if (excelExtensions.includes(fileExtension)) {
                const downloadUrl = `${window.location.origin}/download-document-master/${documentId}`;
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = '';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else if(fileExtension == 'pdf'){
                const pdfUrl = `${window.location.origin}/view-document-master/${documentId}`;
                // alert(pdfUrl)
                $('#pdf-viewer-iframe-view').attr('src', pdfUrl);

                // const downloadUrl = `${window.location.origin}/download-document-master/${documentId}`;
                // $('#download-pdf-btn').attr('href', downloadUrl);
                $('#pdf-viewer-modal-view').modal('show');
            }


        } else {
            alert('Tidak ada dokumen PDF/Excel yang tersedia');
        }
    });

    // $(document).on('click','#download_file_btn_view', function(e){
    //     e.preventDefault();
    //     var id = $('#id-view-docs').val();
    //     const downloadUrl = `${window.location.origin}/download-document-master/${id}`;
    //     $('#download_file_btn_view').attr('href', downloadUrl);
    //     // $('#pdf-viewer-modal').modal('show');
    // })
     $(document).on('click','#updateDocsBtn', function(){
            if (!validateFileSize('edit_file_doc', 10)) {
                return false;
            }
            let id = $('#edit_document_id').val();
            // alert(id)
            var route = "{{ route('masterdocs.update', ':param') }}";
            route_replace = route.replace(':param', id);

            var formData = new FormData($('#editDocumentsForm')[0]);

            $.ajax({
                url: route_replace,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                success: function(response) {
                if (response.status == true) {
                    Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: 'Berhasil Mengubah data',
                            showConfirmButton: true,
                        }).then(function(){
                            $('#edit-documents-master').modal('hide')
                            $('#table-master-manage').DataTable().ajax.reload();
                        });

                } else {
                    alert('error')
                }
                }
            });
        })
        function validateFileSize(inputId, maxSizeMB) {
            const input = document.getElementById(inputId);
            if (input.files.length > 0) {
                const fileSize = input.files[0].size / 1024 / 1024; // Convert to MB
                if (fileSize > maxSizeMB) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Terlalu Besar',
                        text: `Ukuran file tidak boleh lebih dari ${maxSizeMB}MB`,
                        showConfirmButton: true,
                    });
                    input.value = ''; // Clear the file input
                    return false;
                }
            }
            return true;
        }
    $(document).on('click','#destroy-data-masterdocs', function(e){
        e.preventDefault();
        let actionUrl = $(this).attr('data-href');
        Swal.fire({
				title: 'Are you sure?',
				text: 'Delete this data document?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes!',
				cancelButtonText: 'Cancel'
			}).then((result) => {
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				if (result.value) {
					$.ajax({
						url: actionUrl,
						type: "POST",
						data: {
							'_method': 'DELETE',
						},
						success: function(data) {
							if (data.success == true) {
								Swal.fire({
									position: 'top',
									icon: 'success',
									title: 'Success Deleted Data',
									showConfirmButton: false,
									timer: 3000
								})
								$('#table-master-manage').DataTable().ajax.reload();
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Oops...',
									text: 'Something went wrong!',
								})
							}
						}
					});
				} else {
				  console.log(`data was canceled`);
			    }
			});
    })
    $('#btn-filter').click(function() {
		table.ajax.reload();
	});
    $('#btn-reset').click(function() {
        // $('#editDocumentsForm')[0].reset();
        $('#type_docs').val('');
        table.ajax.reload();
    });
// $(document).on('click','#show-create-dar', function(e){
//         e.preventDefault();
//         resetForm();
//         $('#create-reqdar').modal('show');
//     })
//     $('#reqdarForm input, #reqdarForm textarea, #reqdarForm select').on('change keyup', function() {
//         validateForm();
//     });

//     // Radio button change handler
//     $('#reqdarForm input[type="radio"]').on('change', function() {
//         validateForm();
//     });
//      $('input[name="request_desc_id"]').on('change', function() {
//         handleDescriptionChange();
//         validateForm();
//     });
//     function handleDescriptionChange() {
//     var selectedDesc = $('input[name="request_desc_id"]:checked');
//     var revNoContainer = $('#rev_no_before, #rev_no_after').closest('.col-md-3');

//     if (selectedDesc.length > 0) {
//         // Get the label text of selected description
//         var descText = selectedDesc.next('label').text().toLowerCase();

//         if (descText.includes('new issue') || descText.includes('new')) {
//             // Hide Rev No fields
//             revNoContainer.hide();
//             $('#rev_no_before').removeAttr('required').val('');
//             $('#rev_no_after').val('');
//         } else {
//             revNoContainer.show();
//             $('#rev_no_before').attr('required', true);
//         }
//     } else {
//         // If no description selected, show Rev No fields but don't make them required yet
//         revNoContainer.show();
//         $('#rev_no_before').removeAttr('required');
//     }
// }
//     // validasi file_doc
//     $('#file_doc').on('change', function() {
//         var fileInput = this;
//         var fileName = fileInput.files[0] ? fileInput.files[0].name : 'Pilih file PDF atau Excel';
//         $(this).next('.custom-file-label').text(fileName);

//         // Validate file type and size
//         if (fileInput.files.length > 0) {
//             var file = fileInput.files[0];

//             // Allowed file types
//                 var allowedTypes = [
//                     'application/pdf',
//                     'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', // .xlsx
//                     'application/vnd.ms-excel' // .xls
//                 ];

//                 // Get file extension
//                 var fileExtension = file.name.split('.').pop().toLowerCase();
//                 var allowedExtensions = ['pdf', 'xlsx', 'xls'];

//                 // Check file type using MIME type and extension
//                 if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
//                     showNotification('error', 'Hanya file PDF dan Excel (.xlsx, .xls) yang diperbolehkan');
//                     $(this).val(''); // Clear file input
//                     $(this).next('.custom-file-label').text('Pilih file PDF atau Excel');
//                     return false;
//                 }


//                 // Check file size (max 10MB for Excel, 5MB for PDF)
//                 var maxSize = fileExtension === 'pdf' ? 5 * 1024 * 1024 : 10 * 1024 * 1024; // 5MB for PDF, 10MB for Excel
//                 var maxSizeText = fileExtension === 'pdf' ? '5MB' : '10MB';

//                 if (file.size > maxSize) {
//                     showNotification('error', 'Ukuran file maksimal ' + maxSizeText);
//                     $(this).val(''); // Clear file input
//                     $(this).next('.custom-file-label').text('Pilih file PDF atau Excel');
//                     return false;
//                 }

//                 // Show success message for valid file
//                 var fileType = fileExtension === 'pdf' ? 'PDF' : 'Excel';
//                 // showNotification('success', 'File ' + fileType + ' berhasil dipilih: ' + fileName);
//             }


//         // Re-validate the form
//         validateForm();
//     });


//      // Reset form function




//     });





})
</script>
@endpush
