@extends('layouts.app_custom')
@section('title-head','Master Documents')

@section('title','Master Documents')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
@endsection

@section('content')
<section class="section">
    @permission('create-masterdocs')
    <div class="card-header">
        <button type="button" class="btn btn-icon icon-left btn-primary" id="show-create-masterdocs"><i class="fas fa-plus"></i> Add New Documents </button>
        <button type="button" class="btn btn-icon icon-left btn-warning" id="show-create-docs-from-req"><i class="fas fa-plus"></i> Document From Request </button>
    </div>
    @endpermission
    
    <div class="section-body">
        <!-- Filter Card -->
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
                                                @foreach ($typeDoc as $type )
                                                    <option value="{{ $type->id }}">{{ $type->request_type }}</option>
                                                @endforeach
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

        <!-- Main Content Card with Tabs -->
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
                            <button class="close" data-dismiss="alert"></button>
                        </div>
                        @endif

                        <!-- Nav Tabs -->
                        <ul class="nav nav-tabs" id="documentsTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="active-docs-tab" data-toggle="tab" href="#active-docs" role="tab" aria-controls="active-docs" aria-selected="true">
                                    <i class="fas fa-file-alt"></i> New Documents
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="archived-docs-tab" data-toggle="tab" href="#archived-docs" role="tab" aria-controls="archived-docs" aria-selected="false">
                                    <i class="fas fa-archive"></i> Archived Documents
                                </a>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="documentsTabContent">
                            <!-- Active Documents Tab -->
                            <div class="tab-pane fade show active" id="active-docs" role="tabpanel" aria-labelledby="active-docs-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered dataTable no-footer" id="table-active-docs" width="100%" role="grid">
                                        <thead>
                                            <tr>
                                                <th width="7%">No.</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Department</th>
                                                <th class="">Effective Date</th>
                                                <th class="text-center">Type Document</th>
                                                <th class="text-center">Revision Date</th>
                                                <th class="text-center">Documents File</th>
                                                <th class="text-center" width="10%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <!-- Archived Documents Tab -->
                            <div class="tab-pane fade" id="archived-docs" role="tabpanel" aria-labelledby="archived-docs-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered dataTable no-footer" id="table-archived-docs" width="100%" role="grid">
                                        <thead>
                                            <tr>
                                                <th width="7%">No.</th>
                                                <th class="text-center">Title</th>
                                                <th class="text-center">Department</th>
                                                <th class="">Effective Date</th>
                                                <th class="text-center">Type Document</th>
                                                <th class="text-center">Archive Date</th>
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
            </div>
        </div>
    </div>
</section>
@endsection

@push('js')
@include('request-dar.masterdocs.create')
@include('request-dar.masterdocs.edit')
@include('request-dar.masterdocs.show')
@include('request-dar.masterdocs.view-docs.view-docs-edit')
@include('request-dar.masterdocs.view-docs.view-docs-view')
@include('request-dar.masterdocs.doc-from-req')
@include('request-dar.masterdocs.data-reqdar')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function(){
    // Initialize both DataTables
    var activeTable = initializeDataTable('#table-active-docs', 'new');
    var archivedTable = initializeDataTable('#table-archived-docs', 'archived');

    // Function to initialize DataTable
    function initializeDataTable(tableSelector, status) {
        return $(tableSelector).DataTable({
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
            deferRender: true,
            ajax: {
                url: "{{ route('masterdocs.index') }}",
                data: function(d) {
                    d.type_docs = $('#type_docs').val();
                    d.status = status; // Add status parameter to distinguish between active and archived
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
                { data: 'dept_name', name: 'dept_name', className:'text-center' },
                { data: 'effective_date', name: 'effective_date', className:'text-center' },
                { data: 'type_doc_name', name: 'type_doc_name',className: 'text-center' },
                { data: status === 'archived' ? 'archived_date' : 'updated_at', name: status === 'archived' ? 'archived_date' : 'updated_at', className: 'text-center' },
                { data: 'file', name: 'file',className: 'text-left' },
                { data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center' }
            ]
        });
    }

    // Tab switch event handler
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if (target === '#active-docs') {
            activeTable.ajax.reload();
        } else if (target === '#archived-docs') {
            archivedTable.ajax.reload();
        }
    });

    // Filter buttons
    $('#btn-filter').click(function() {
        activeTable.ajax.reload();
        archivedTable.ajax.reload();
    });

    $('#btn-reset').click(function() {
        $('#type_docs').val('');
        activeTable.ajax.reload();
        archivedTable.ajax.reload();
    });

    // Create document button handler
    $(document).on('click','#show-create-masterdocs', function(){
        $('#add-documents-master').modal('show');
        $('#documentsForm input, #documentsForm textarea, #documentsForm select').on('change keyup', function() {
            validateForm();
        });
    });
    $(document).on('click','#show-create-docs-from-req', function(){
        $('#add-documents-from-req').modal('show');
        $('#documentsForm input, #documentsForm textarea, #documentsForm select').on('change keyup', function() {
            validateForm();
        });
    });

    // Submit document handler
    $('.submitdocs').on('click', function() {
        if (!validateForm()) {
            showNotification('warning', 'Lengkapi semua field yang diperlukan');
            return false;
        }

        var formData = new FormData($('#documentsForm')[0]);

        var selectedCount = addDepartmentsToFormData(formData);

        // check what's being sent
        console.log('Selected departments count:', selectedCount);
        console.log('Selected departments:', getSelectedDepartments());

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
                    activeTable.ajax.reload();
                    archivedTable.ajax.reload();
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
            $('#documentsForm')[0].reset();
            $('.custom-file-label').text('Pilih file PDF/Excel');
            $('#documentsForm input, #documentsForm textarea, #documentsForm select').prop('disabled', false);
        }
    });

    // Show document details
    $(document).on('click','#show-data-masterdocs', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let route = "{{ route('masterdocs.show', ':id') }}";
        let url = route.replace(':id', window.btoa(id))

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response)
                $('#view-document-modal').modal('show');
                $('#id-view-docs').val(response.id)
                $('#view_document_').html(response.title);
                $('#view_description').html(response.description);
                $('#view_type_badge').html(response.type_doc_name);
                $('#departments-view').html(response.dept_name);
                $('#effective-date-view').html(response.effective_date);
                $('#revision-date-view').html(response.updated_at == null ? 'Belum ada revisi': response.updated_at);
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
                console.error('Error fetching Master Docs details:', error);
                alert('Failed to load request details. Please try again.');
            }
        })
    });

    // Edit document handler
    $(document).on('click','#edit-data-masterdocs', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let route = "{{ route('masterdocs.edit', ':id') }}";
        let url = route.replace(':id', window.btoa(id))

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response)
                $('#edit-documents-master').modal('show');
                $('#edit_document_id').val(response.id)
                $('#edit_title').val(response.title);
                $('#edit_description').val(response.description);
                $('#edit_type_docs').val(response.type_doc_id).trigger('change');
                $('#departments-edit').val(response.dept_id).trigger('change');
                $('#effective-date-edit').val(response.effective_date);
                $('#file-storage-edit').val(response.file);
                
                if (response.file) {
                    const fileName = response.file.split('/').pop();
                    $('#current_file_name').val(fileName);
                    $('#pdf-file-name').text(fileName);
                    $('#view_current_file').data('document-id', response.id);
                    $('#view_current_file').prop('disabled', false);
                } else {
                    $('#pdf-file-name').text('Tidak ada file');
                    $('#view_current_file').prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching Master Docs details:', error);
                alert('Failed to load request details. Please try again.');
            }
        })
    });

    // View current file handlers
    $(document).on('click', '#view_current_file', function() {
        const documentId = $(this).data('document-id');
        let urlFiledoc = $('#file-storage-edit').val();

        if (documentId && urlFiledoc) {
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
        let urlFiledoc = $('#file-storage-view').val();

        if (documentId && urlFiledoc) {
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
                $('#pdf-viewer-iframe-view').attr('src', pdfUrl);
                $('#pdf-viewer-modal-view').modal('show');
            }
        } else {
            alert('Tidak ada dokumen PDF/Excel yang tersedia');
        }
    });

    // Update document handler
    $(document).on('click','#updateDocsBtn', function(){
        if (!validateFileSize('edit_file_doc', 10)) {
            return false;
        }
        let id = $('#edit_document_id').val();
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
                        activeTable.ajax.reload();
                        archivedTable.ajax.reload();
                    });
                } else {
                    alert('error')
                }
            }
        });
    });

    // Delete document handler
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
                            activeTable.ajax.reload();
                            archivedTable.ajax.reload();
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
    });

    // Utility functions
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
        $('#documentsForm input[type="text"], #documentsForm input[type="number"], #documentsForm textarea').each(function() {
            if ($(this).prop('required') && !$(this).val().trim()) {
                isValid = false;
                return false;
            }
        });

        if (!$('#title').val() ||
            !$('#description').val().trim() ||
            !$('#type-docs').val().trim() || 
            !$('.dept-checkbox').val().trim() || 
            !$('#effective-date').val().trim()) {
            isValid = false;
        }

        if ($('#file_doc').prop('required') && $('#file_doc').val() === '') {
            isValid = false;
        }

        $('.submitdocs').prop('disabled', !isValid);
        return isValid;
    }

    function validateFileSize(inputId, maxSizeMB) {
        const input = document.getElementById(inputId);
        if (input.files.length > 0) {
            const fileSize = input.files[0].size / 1024 / 1024;
            if (fileSize > maxSizeMB) {
                Swal.fire({
                    icon: 'error',
                    title: 'File Terlalu Besar',
                    text: `Ukuran file tidak boleh lebih dari ${maxSizeMB}MB`,
                    showConfirmButton: true,
                });
                input.value = '';
                return false;
            }
        }
        return true;
    }
});
    $(document).ready(function(){
       $('#title-from-req').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                openDocumentLookup();
            }
        });
        let lookupData;
        function openDocumentLookup() {
            $('#document-lookup-fromreq-modal').appendTo('body').modal('show');

            if ($.fn.DataTable.isDataTable('#document-table')) {
                lookupData = $('#document-table').DataTable();
                lookupData.ajax.reload();
            } else {
                lookupData = $('#document-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('lookupdokumendar') }}",
                        data: function(d) {
                            d.filterType = $('#filter-type').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className:'text-center' },
                        { data: 'no_doc', name: 'no_doc' },
                        { data: 'name_doc', name: 'name_doc' },
                        { data: 'department', name: 'department' },
                        { data: 'file', name: 'file' }
                    ],
                    bDestroy: true
                });

                // ONLY bind once!
                $('#document-table tbody').on('click', 'tr', function () {
                    var data = lookupData.row(this).data();
                    var match = data.title.match(/^([A-Z]{2}-\d{2}-\d{3})\s+(.+)$/);

                    if (match) {
                        var noDoc = match[1];
                        var nameDocRaw = match[2];
                        var nameDoc = $('<textarea/>').html(nameDocRaw).text();
                         $('#no-doc').val(noDoc);
                         $('#name-doc').val(nameDoc);
                        
                    } else {
                        $('#no-doc').val('');
                        $('#name-doc').val('');
                    }

                    $('#document-lookup-fromreq-modal').modal('hide');
                });
            }
        }

           $('#filter-type').on('change', function() {
                 $('#document-table').DataTable().ajax.reload();
            });

            $('#document-lookup-fromreq-modal').on('hidden.bs.modal', function () {
                if ($('.modal.show').length > 0) {
                    $('body').addClass('modal-open'); // menjaga scroll modal utama
                }
            });

    })
</script>
@endpush