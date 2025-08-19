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
        <button type="button" class="btn btn-icon icon-left btn-primary" id="show-create-masterdocs"><i class="fas fa-plus"></i> Add New Documents / Add From Request</button>
        {{-- <button type="button" class="btn btn-icon icon-left btn-warning" id="show-create-docs-from-req"><i class="fas fa-plus"></i> Document From Request </button> --}}
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
                                    <i class="fas fa-file-alt"></i> All Documents
                                </a>
                            </li>
                             <li class="nav-item">
                                @role('user-employee')
                                <a class="nav-link" id="my-docs-tab" data-toggle="tab" href="#my-docs" role="tab" aria-controls="my-docs" aria-selected="false">
                                    <i class="fas fa-archive"></i> My Documents
                                </a>
                                @endrole
                            </li>
                            <li class="nav-item">
                                @role('sysdev')
                                <a class="nav-link" id="archived-docs-tab" data-toggle="tab" href="#archived-docs" role="tab" aria-controls="archived-docs" aria-selected="false">
                                    <i class="fas fa-archive"></i> Archived Documents
                                </a>
                                @endrole
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
                                                {{-- <th class="text-center">Department</th> --}}
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

                            <!-- My Documents Tab -->
                            <div class="tab-pane fade" id="archived-docs" role="tabpanel" aria-labelledby="archived-docs-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered dataTable no-footer" id="table-archived-docs" width="100%" role="grid">
                                        <thead>
                                            <tr>
                                                <th width="7%">No.</th>
                                                <th class="text-center">Title</th>
                                                {{-- <th class="text-center">Department</th> --}}
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
                              <div class="tab-pane fade" id="my-docs" role="tabpanel" aria-labelledby="my-docs-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-bordered dataTable no-footer" id="table-my-docs" width="100%" role="grid">
                                        <thead>
                                            <tr>
                                                <th width="7%">No.</th>
                                                <th class="text-center">Title</th>
                                                {{-- <th class="text-center">Department</th> --}}
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
{{-- @include('request-dar.masterdocs.doc-from-req') --}}
@include('request-dar.masterdocs.data-reqdar')
@include('request-dar.masterdocs.data-reqdar-edit')
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>
<script>
$(document).ready(function(){
    // Initialize both DataTables
    var activeTable = initializeDataTable('#table-active-docs', 'all-docs');
    var archivedTable = initializeDataTable('#table-archived-docs', 'archived');
    var myDocsTable = initializeDataTable('#table-my-docs', 'my-docs');
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
                // { data: 'dept_name', name: 'dept_name', className:'text-center' },
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
        } else if(target === '#my-docs'){
            myDocsTable.ajax.reload();
        }
    });

    // Filter buttons
    $('#btn-filter').click(function() {
        activeTable.ajax.reload();
        archivedTable.ajax.reload();
        myDocsTable.ajax.reload();
    });

    $('#btn-reset').click(function() {
        $('#type_docs').val('');
        activeTable.ajax.reload();
        archivedTable.ajax.reload();
        myDocsTable.ajax.reload();
    });

    // Create document button handler
    $(document).on('click','#show-create-masterdocs', function(){
        $('#add-documents-master').modal('show');
        $('#documentsForm input, #documentsForm textarea, #documentsForm select').on('change keyup', function() {
            validateForm();
        });
    });
    // $(document).on('click','#show-create-docs-from-req', function(){
    //     $('#add-documents-from-req').modal('show');
    //     $('#documentsForm input, #documentsForm textarea, #documentsForm select').on('change keyup', function() {
    //         validateFormReq();
    //     });
    // });

    // Submit document handler
    $('.submitdocs').on('click', function() {
        if (!validateForm()) {
            showNotification('warning', 'Lengkapi semua field yang diperlukan');
            return false;
        }
        if (!validateDepartmentSelection()) {
            return false;
        }

        var formData = new FormData($('#documentsForm')[0]);

        formData.append('title', $('#title').val());
        formData.append('description', $('#description').val());
        formData.append('type_docs', $('#type-docs').val());
        formData.append('effective_date', $('#effective-date').val());
        formData.append('is_archived', $('input[name="is_archived"]:checked').val());
        formData.append('status-doc', $('#status-doc').val());
        formData.append('_token', $('input[name="_token"]').val());

         // Handle departments array properly
        var selectedDepartments = getSelectedDepartments();
        // selectedDepartments.forEach(function(deptId, index) {
        //     formData.append('departments[]', deptId);
        // });

        var isArchived = $('input[name="is_archived"]:checked').val();
        var existingFilePath = $('#existing-file-path').val();
        var existingFileName = $('#existing-file-name').val();
        var reqdarId = $('#reqdar-id').val();

        if (isArchived === 'archived' && existingFilePath) {
            formData.append('existing_file_path', existingFilePath);
            formData.append('existing_file_name', existingFileName);
            formData.append('reqdar_id', reqdarId);
            formData.append('use_existing_file', '1');
            
            // Check if user also uploaded a new file (to replace existing one)
            var fileInput = $('#file_doc')[0];
            if (fileInput.files.length > 0) {
                formData.append('file_doc', fileInput.files[0]);
                formData.append('replace_existing_file', '1');
            }
        } else {
            // New document or archived without existing file - file upload required
            var fileInput = $('#file_doc')[0];
            if (fileInput.files.length > 0) {
                formData.append('file_doc', fileInput.files[0]);
            } else {
                showNotification('error', 'File upload diperlukan untuk dokumen baru');
                return false;
            }
            formData.append('use_existing_file', '0');
    }
        // console.log(isArchived)

        // var selectedCount = addDepartmentsToFormData(formData);

        // check what's being sent
        // console.log('Selected departments count:', selectedCount);
        // console.log('Selected departments:', getSelectedDepartments());

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
                     closeModal();
                    showNotification('success', response.message || 'Document berhasil ditambahkan');
                
                    // Reload tables if they exist
                    if (typeof activeTable !== 'undefined') {
                        activeTable.ajax.reload();
                    }
                    if (typeof archivedTable !== 'undefined') {
                        archivedTable.ajax.reload();
                    }
                    // $('#create-reqdar').modal('hide');
                    // showNotification('success', response.message);
                    // activeTable.ajax.reload();
                    // archivedTable.ajax.reload();
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

        const $button = $(this);
        const originalText = $button.html();
        // $button.html('<i class="fas fa-spinner fa-spin me-1"></i>Loading...').prop('disabled', true);

        let id = $(this).data('id');
        let route = "{{ route('masterdocs.show', ':id') }}";
        let url = route.replace(':id', window.btoa(id))

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                // console.log(response)
                if (response.success === false) {
                    showAlert('error', response.message || 'Failed to load document details');
                    return;
                }
                //   $button.html('<i class="fas fa-spinner fa-spin me-1"></i>Loading...').prop('disabled', true);
                 const data = response.data || response;
                $('#view-document-modal').modal('show');

                $('#id-view-docs').val(response.id)
                $('#view_document_title').text(data.title || 'Untitled Document');
                $('#view_document_title_content').text(data.title || 'Untitled Document');
                $('#view_document_').html(response.title);
                
                const typeBadge = $('#view_type_badge');
                typeBadge.html(data.type_doc_name || 'Unknown Type');

                const description = data.description || 'No description available';
                $('#view_description').html(description === 'No description available' ? 
                    '<span class="text-muted font-italic">No description available</span>' : description);
                const deptContainer = $('#departments-view');
                
                const departments = data.distribution_depts || [];
                if (departments && departments.length > 0) {
                    const deptHtml = departments.map(dept => {
                        const deptName = dept.dept_name || dept.name || 'Unknown Department';
                        return `<span class="badge bg-primary me-1 mb-1 text-white">${deptName}</span>`;
                    }).join('');
                    
                    deptContainer.html(deptHtml);
                } else {
                    deptContainer.html('<span class="text-muted font-italic">No departments assigned</span>');
                }
                $('#effective-date-view').html(formatDisplayDate(data.effective_date));
                $('#revision-date-view').html(
                    data.updated_at ? formatDisplayDate(data.updated_at) : 
                    '<span class="text-muted font-italic">No revisions yet</span>'
                );
                populateDocumentStatus(data)
                populateFileAttachment(data);
                if (data.created_at_formatted) {
                    $('#created-date-view').html(data.created_at_formatted);
                }

                // toggleActionButtons(data);
                // $('#view_description').html(response.description);
                // $('#view_type_badge').html(response.type_doc_name);
                // $('#departments-view').html(response.dept_name);
                // $('#effective-date-view').html(response.effective_date);
                // $('#revision-date-view').html(response.updated_at == null ? 'Belum ada revisi': response.updated_at);
                // $('#file-storage-view').val(response.file);
                
                if (data.file) {
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
    function populateDocumentStatus(data) {
        const statusElement = $('#document-status');
            
            if (statusElement.length) {
                const archiveStatus = data.is_archived ? data.is_archived.toLowerCase() : 'new';
                
                let statusText, statusClass, statusIcon;
                
                switch(archiveStatus) {
                    case 'archived':
                        statusText = 'Archived';
                        statusClass = 'bg-danger';
                        statusIcon = 'fas fa-archive';
                        break;
                    case 'new':
                    default:
                        statusText = 'New Document';
                        statusClass = 'bg-success';
                        statusIcon = 'fas fa-check-circle';
                        break;
                }
                
                statusElement
                    .removeClass('bg-success bg-danger bg-warning bg-info bg-secondary')
                    .addClass(`badge ${statusClass} text-white`)
                    .html(`<i class="${statusIcon} me-1"></i>${statusText}`);
            }
    }
    function populateFileAttachment(data) {
            const fileNameElement = $('#view_file_name');
            const fileViewBtn = $('#view_file_btn');
            const fileDownloadBtn = $('#download_file_btn_view');
            const fileStorageInput = $('#file-storage-view');
            const fileIconElement = $('#view_file_icon');
            
            if (data.file && data.file.trim() !== '') {
                // Extract filename
                const fileName = data.file.split('/').pop() || data.file;
                fileNameElement.text(fileName);
                fileStorageInput.val(data.file);
                
                // Set appropriate file icon
                setFileIcon(fileIconElement, data.file_extension || getFileExtension(fileName));
                
                // Enable view button
                fileViewBtn
                    .data('document-id', data.id)
                    .data('file-path', data.file_path || data.file)
                    .prop('disabled', false)
                    .show();
                
                // Set download URL
                const downloadUrl = data.file_path || 
                    `${window.location.origin}/download-document-master/${data.id}`;
                fileDownloadBtn.attr('href', downloadUrl).show();
                
                // Add file size if available
                if (data.file_size) {
                    const sizeSpan = `<small class="text-muted d-block">Size: ${data.file_size}</small>`;
                    fileNameElement.after(sizeSpan);
                }
                
            } else {
                // No file attached
                fileNameElement.html('<span class="text-muted font-italic">No file attached</span>');
                fileViewBtn.prop('disabled', true).hide();
                fileDownloadBtn.attr('href', '#').hide();
                fileStorageInput.val('');
                
                // Set default file icon
                fileIconElement
                    .removeClass()
                    .addClass('fas fa-file me-2 text-muted');
            }
        }
        function setFileIcon(iconElement, extension) {
                iconElement.removeClass(); // Remove all classes
                
                const ext = extension ? extension.toLowerCase() : '';
                
                switch(ext) {
                    case 'pdf':
                        iconElement.addClass('fas fa-file-pdf me-2 text-danger');
                        break;
                    case 'doc':
                    case 'docx':
                        iconElement.addClass('fas fa-file-word me-2 text-primary');
                        break;
                    case 'xls':
                    case 'xlsx':
                        iconElement.addClass('fas fa-file-excel me-2 text-success');
                        break;
                    case 'ppt':
                    case 'pptx':
                        iconElement.addClass('fas fa-file-powerpoint me-2 text-warning');
                        break;
                    case 'jpg':
                    case 'jpeg':
                    case 'png':
                    case 'gif':
                        iconElement.addClass('fas fa-file-image me-2 text-info');
                        break;
                    case 'zip':
                    case 'rar':
                    case '7z':
                        iconElement.addClass('fas fa-file-archive me-2 text-secondary');
                        break;
                    default:
                        iconElement.addClass('fas fa-file me-2 text-muted');
                }
            }
        function showAlert(type, message) {
            // Remove existing alerts
            $('.custom-alert').remove();
            
            const alertClass = type === 'error' ? 'alert-danger' : 
                            type === 'success' ? 'alert-success' : 
                            'alert-info';
            
            const alertHtml = `
                <div class="alert ${alertClass} alert-dismissible fade show custom-alert" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                    <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    ${message}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            `;
            
            $('body').append(alertHtml);
            
            // Auto hide after 5 seconds
            setTimeout(() => {
                $('.custom-alert').fadeOut();
            }, 5000);
        }
        function getFileExtension(filename) {
            return filename.split('.').pop();
        }

        /**
         * Format date for display with fallback
         */
        function formatDisplayDate(dateString) {
            if (!dateString) return '<span class="text-muted">Not specified</span>';
            
            try {
                const date = new Date(dateString);
                const options = { 
                    year: 'numeric', 
                    month: 'long', 
                    day: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit'
                };
                return date.toLocaleDateString('en-US', options);
            } catch (error) {
                return '<span class="text-muted">Invalid date</span>';
            }
        }
        // $(document).on('click', '#view_file_btn', function(e) {
        //     e.preventDefault();
            
        //     const documentId = $(this).data('document-id');
        //     const filePath = $(this).data('file-path');
            
        //     if (documentId) {
        //         // Open file in new window or modal
        //         const viewUrl = `${window.location.origin}/view-document-file/${documentId}`;
        //         window.open(viewUrl, '_blank');
        //     }
        // });
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
                // console.log(response)
                 let data = response;
            
                // If response has attributes property, use that for the main data
                if (response.attributes) {
                    data = response.attributes;
                }

                // console.log(data);
               $('#edit-documents-master').modal('show');
            
               // Populate basic fields
                $('#edit_document_id').val(data.id || response.id);
                $('#edit_title').val(data.title || '');
                $('#edit_description').val(data.description || '');
                $('#edit_type_docs').val(data.type_doc_id || '').trigger('change');
                $('#effective-date-edit').val(data.effective_date || '');
                $('#file-storage-edit').val(data.file || '');

                let archiveStatus = data.is_archived || response.is_archived;
                if (archiveStatus) {
                    $('input[name="is_archived"][value="' + archiveStatus + '"]').prop('checked', true);
                }
                $('.dept-checkbox').prop('checked', false);
                $('#select_all_dept_edit').prop('checked', false);

                 let distributionDept = response.distribution_dept || [];
                //  console.log('Distribution departments:', distributionDept);
                
                if (distributionDept && distributionDept.length > 0) {
                    distributionDept.forEach(function(deptId) {
                        $('#dept_' + deptId + '_edit').prop('checked', true);
                    });
                    
                    // Update the selected count
                    updateSelectedDeptCountEdit();
                    
                    // Check if all departments are selected to update "Select All" checkbox
                    updateSelectAllStateEdit();
                }

                let fileUrl = data.file || response.file;
                if (fileUrl) {
                    const fileName = fileUrl.split('/').pop();
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
    function updateSelectedDeptCountEdit() {
        const checkedCount = $('.dept-checkbox:checked').length;
        $('#selected-dept-count-edit').text(checkedCount);
    }
    function toggleAllDepartmentsEdit(selectAllCheckbox) {
        const isChecked = selectAllCheckbox.checked;
        $('.dept-checkbox').prop('checked', isChecked);
        updateSelectedDeptCountEdit();
    }
    function updateSelectAllStateEdit() {
        const totalDepts = $('.dept-checkbox').length;
        const checkedDepts = $('.dept-checkbox:checked').length;
        
        if (checkedDepts === 0) {
            $('#select_all_dept_edit').prop('indeterminate', false);
            $('#select_all_dept_edit').prop('checked', false);
        } else if (checkedDepts === totalDepts) {
            $('#select_all_dept_edit').prop('indeterminate', false);
            $('#select_all_dept_edit').prop('checked', true);
        } else {
            $('#select_all_dept_edit').prop('indeterminate', true);
        }
        
        updateSelectedDeptCountEdit();
    }
    $(document).on('change', '.dept-checkbox', function() {
        updateSelectAllStateEdit();
    });
    function fixRadioButtonIds() {
        // This should be called when modal is shown or update the HTML directly
        $('input[name="is_archived"]').each(function(index) {
            if ($(this).val() === 'new') {
                $(this).attr('id', 'is_archived_edit');
                $(this).next('label').attr('for', 'is_archived_edit');
            } else if ($(this).val() === 'archived') {
                $(this).attr('id', 'is_archived_edit');
                $(this).next('label').attr('for', 'is_archived_edit');
            }
        });
    }
    $('#edit-documents-master').on('shown.bs.modal', function() {
        fixRadioButtonIds();
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
    $(document).on('click','#updateDocsBtn', function(e){
         e.preventDefault();

        if (!validateFileSize('edit_file_doc', 10)) {
            return false;
        }
         if (!validateEditForm()) {
            return false;
        }
        let id = $('#edit_document_id').val();
        if (!id) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Document ID not found',
                showConfirmButton: true,
            });
            return false;
        }

        $('#updateDocsBtn').prop('disabled', true).html('<i class="fa fa-spinner fa-spin"></i> Updating...');

        var route = "{{ route('masterdocs.update', ':param') }}";

        route_replace = route.replace(':param', id);

        var formData = new FormData($('#editDocumentsForm')[0]);
        formData.append('_method', 'PUT');

         $('.dept-checkbox:checked').each(function() {
            checkedDepts.push($(this).val());
            formData.append('departments[]', $(this).val());
        });

        $.ajax({
            url: route_replace,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            success: function(response) {
                $('#updateDocsBtn').prop('disabled', false).html('<i class="fa fa-save"></i> Update');
                if (response.success === true || response.status == true) {
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
            !$('#is_archived').val().trim() ||
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
      function validateDepartmentSelection() {
            var checkedCount = $('.dept-checkbox:checked').length;
            if (checkedCount === 0) {
                showNotification('error', 'Pilih minimal satu department untuk distribusi');
                return false;
            }
            return true;
    }
    // function validateFormReq() {
    //     var isValid = true;
    //     $('#documentsForm input[type="text"], #documentsForm input[type="number"], #documentsForm textarea').each(function() {
    //         if ($(this).prop('required') && !$(this).val().trim()) {
    //             isValid = false;
    //             return false;
    //         }
    //     });

    //     if (!$('#title-req').val() ||
    //         !$('#description-req').val().trim() ||
    //         !$('#type-docs-req').val().trim() || 
    //         !$('.dept-checkbox').val().trim() || 
    //         !$('#effective-date-req').val().trim()) {
    //         isValid = false;
    //     }

    //     if ($('#file_doc_req').prop('required') && $('#file_doc_req').val() === '') {
    //         isValid = false;
    //     }

    //     $('.submitdocs').prop('disabled', !isValid);
    //     return isValid;
    // }
    function validateEditForm() {
        let isValid = true;
        let errorMessages = [];
        
        // Check required fields
        if (!$('#edit_title').val().trim()) {
            errorMessages.push('Title is required');
            $('#edit_title').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_title').removeClass('is-invalid');
        }
        
        if (!$('#edit_description').val().trim()) {
            errorMessages.push('Description is required');
            $('#edit_description').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_description').removeClass('is-invalid');
        }
        
        if (!$('#edit_type_docs').val()) {
            errorMessages.push('Document type is required');
            $('#edit_type_docs').addClass('is-invalid');
            isValid = false;
        } else {
            $('#edit_type_docs').removeClass('is-invalid');
        }
        
        if (!$('#effective-date-edit').val()) {
            errorMessages.push('Effective date is required');
            $('#effective-date-edit').addClass('is-invalid');
            isValid = false;
        } else {
            $('#effective-date-edit').removeClass('is-invalid');
        }
        
        // Check archive status
        if (!$('input[name="is_archived"]:checked').length) {
            errorMessages.push('Archive status is required');
            isValid = false;
        }
        
        // Check departments
        if (!$('.dept-checkbox-edit:checked').length) {
            errorMessages.push('At least one department must be selected');
            isValid = false;
        }
        
        if (!isValid) {
            Swal.fire({
                icon: 'warning',
                title: 'Validation Error!',
                html: errorMessages.join('<br>'),
                showConfirmButton: true,
            });
        }
        
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
       $('#title').on('keypress', function(e) {
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
                    // console.log(data)
                
                    var reqdarId = data.reqdar_id;

                    var deptIdsStr = data.distribution_dept_ids || "";
                 
                    var deptIds = deptIdsStr.split(',').map(function(id) {
                        return id.trim();
                    });
                    //    console.log(deptIds)
                    // $('.dept-checkbox').prop('checked', false);
                    var count;
                    deptIds.forEach(function(id) {
                        // console.log(id)
                         $('.dept-checkbox[value="'+id+'"]').prop('checked', true);
                      
                        // $('#dept_' + id).prop('checked', true);
                    });
                    $('#title').val(data.no_doc + ' '+ data.name_doc || '');
                    $('#description').val(data.description || '-');
                    // console.log(data.eff_dates)
                    $('#effective-date').val(data.eff_dates);
                    // console.log(data.typereqform_id)
                    $('#type-docs').val(data.typereqform_id).trigger('change');

                //    $('input[name="is_archived"][value="archived"]').prop('checked', true);

                    // $('#is_archived').prop('checked', true);
                
                    // Extract filename from the display field and get actual file path
                    var displayFile = data.file; // HTML dengan icon
                    var actualFilePath = data.file_doc; // Path file sebenarnya
                    var extractedFileName = extractFileName(displayFile);

                    $('#existing-file-path').val(actualFilePath);
                    $('#existing-file-name').val(extractedFileName);
                    $('#reqdar-id').val(reqdarId);

                    $('.custom-file-label').text(extractedFileName + ' (From Request)')
                    .addClass('text-info font-weight-bold');
                
                    // Make file upload optional since we have file from request
                    $('#file_doc').prop('required', false);
                    
                  
                    showFilePreview(extractedFileName, actualFilePath);
                    
                    // Update department counts
                    updateSelectedDeptCount();
                    updateSelectAllState();
                   
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

        function updateSelectedCountDepts() {
            const checkedCount = $('.dept-checkbox:checked').length;
            $('#selected-dept-count').text(checkedCount);
            
            // Optional: Tambahkan styling berdasarkan jumlah
            const countElement = $('#selected-dept-count');
            if (checkedCount > 0) {
                countElement.addClass('text-primary font-weight-bold');
            } else {
                countElement.removeClass('text-primary font-weight-bold');
            }
        }
        function updateSelectAllState() {
            const totalCheckboxes = $('.dept-checkbox').length;
            const checkedCheckboxes = $('.dept-checkbox:checked').length;
            const selectAllCheckbox = $('#select_all_dept')[0];
            
            if (checkedCheckboxes === 0) {
                // Tidak ada yang dipilih
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
            } else if (checkedCheckboxes === totalCheckboxes) {
                // Semua dipilih
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
            } else {
                // Sebagian dipilih
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = true;
            }
            
            // Update counter
            updateSelectedCountDepts();
        }
        function extractFileName(fileString) {
            return fileString
                .replace(/<[^>]*>/g, '') // Remove HTML tags
                .replace(/\r\n|\r|\n/g, '') // Remove line breaks
                .trim(); // Remove leading/trailing whitespace
        }

         function showFilePreview(fileName, filePath) {
          // Buat preview area jika belum ada
            var previewHtml = `
                <div id="file-preview-area" class="mt-2 p-2 bg-light border rounded">
                    <small class="text-info">
                        <i class="fas fa-info-circle"></i> File from Request:
                    </small>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">${fileName}</span>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="downloadPreviewFile('${filePath}')">
                            <i class="fas fa-download"></i> Preview
                        </button>
                    </div>
                </div>
            `;
            
            // Remove existing preview
            $('#file-preview-area').remove();
            
            // Add new preview after file input
            $('.custom-file').after(previewHtml);
        }
        
        // Function untuk download/preview file
        $('#edit_title').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                openDocumentLookupEdit();
            }
        });
        let lookupDataEdit;
        function openDocumentLookupEdit() {
            $('#document-lookup-fromreq-modal-edit').appendTo('body').modal('show');

            if ($.fn.DataTable.isDataTable('#document-table-edit')) {
                lookupDataEdit = $('#document-table-edit').DataTable();
                lookupDataEdit.ajax.reload();
            } else {
                lookupDataEdit = $('#document-table-edit').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('lookupdokumendar') }}",
                        data: function(d) {
                            d.filterType = $('#filter-type-edit').val();
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
                $('#document-table-edit tbody').on('click', 'tr', function () {
                    var data = lookupDataEdit.row(this).data();
                    // console.log(data)
                
                    var reqdarId = data.reqdar_id;

                    var deptIdsStr = data.distribution_dept_ids || "";
                 
                    var deptIds = deptIdsStr.split(',').map(function(id) {
                        return id.trim();
                    }).filter(function(id) {
                        return id !== ""; 
                    });
                    //    console.log(deptIds)
                    $('.dept-checkbox-edit').prop('checked', false);

                    var count;
                    deptIds.forEach(function(id) {
                           if(id !== "") {
                            var checkbox = $('.dept-checkbox-edit[value="'+id+'"]');
                            if(checkbox.length > 0) {
                                checkbox.prop('checked', true);
                                console.log('Checked department:', id);
                            } else {
                                console.warn('Checkbox with value ' + id + ' not found');
                            }
                        }
                        
                      
                        // $('#dept_' + id).prop('checked', true);
                    });
                    $('#edit_title').val(data.no_doc + ' '+ data.name_doc || '');
                    $('#edit_description').val(data.description || '-');
                    // console.log(data.eff_dates)
                    $('#effective-date-edit').val(data.eff_dates);
                    // console.log(data.typereqform_id)
                    $('#edit_type_docs').val(data.typereqform_id).trigger('change');

                    // $('input[name="is_archived"][value="'+data.is_archived+'"]').prop('checked', false);
                    $('input[name="is_archived"][value="'+data.is_archived+'"]').prop('checked', true);
                    // $('#is_archived').prop('checked', true);
                
                    // Extract filename from the display field and get actual file path
                    var displayFile = data.file; 
                    var actualFilePath = data.file_doc; // Path file sebenarnya
                    var extractedFileName = extractFileNameEdit(displayFile);

                    $('#existing-file-path-edit').val(actualFilePath);
                    $('#existing-file-name-edit').val(extractedFileName);
                    $('#reqdar-id-edit').val(reqdarId);

                    $('.custom-file-label').text(extractedFileName + ' (From Request)')
                    .addClass('text-info font-weight-bold');
                
                    // Make file upload optional since we have file from request
                    $('#file_doc').prop('required', false);
                    
                  
                    showFilePreviewEdit(extractedFileName, actualFilePath);
                    
                    // Update department counts
                    updateSelectedDeptCountLookUp();
                    updateSelectAllStateLookUp();
                   
                    $('#document-lookup-fromreq-modal-edit').modal('hide');

                });
            }
        }

           $('#filter-type-edit').on('change', function() {
                 $('#document-table-edit').DataTable().ajax.reload();
            });

            $('#document-lookup-fromreq-modal-edit').on('hidden.bs.modal', function () {
                if ($('.modal.show').length > 0) {
                    $('body').addClass('modal-open'); // menjaga scroll modal utama
                }
            });
        
    
        function extractFileNameEdit(fileString) {
            return fileString
                .replace(/<[^>]*>/g, '') // Remove HTML tags
                .replace(/\r\n|\r|\n/g, '') // Remove line breaks
                .trim(); // Remove leading/trailing whitespace
        }
        function updateSelectedDeptCountLookUp() {
            const checkedCount = $('.dept-checkbox-edit:checked').length;
            $('#selected-dept-count-edit').text(checkedCount);
        }
        function updateSelectAllStateLookUp() {
            const totalDepts = $('.dept-checkbox-edit').length;
            const checkedDepts = $('.dept-checkbox-edit:checked').length;
            
            if (checkedDepts === 0) {
                $('#select_all_dept_edit').prop('indeterminate', false);
                $('#select_all_dept_edit').prop('checked', false);
            } else if (checkedDepts === totalDepts) {
                $('#select_all_dept_edit').prop('indeterminate', false);
                $('#select_all_dept_edit').prop('checked', true);
            } else {
                $('#select_all_dept_edit').prop('indeterminate', true);
            }
            
            updateSelectedDeptCountLookUp();
        }
        function showFilePreviewEdit(fileName, filePath) {
          // Buat preview area jika belum ada
            var previewHtml = `
                <div id="file-preview-area-edit" class="mt-2 p-2 bg-light border rounded">
                    <small class="text-info">
                        <i class="fas fa-info-circle"></i> File from Request:
                    </small>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="font-weight-bold">${fileName}</span>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="downloadPreviewFileEdit('${filePath}')">
                            <i class="fas fa-download"></i> Preview
                        </button>
                    </div>
                </div>
            `;
            
            // Remove existing preview
            $('#file-preview-area-edit').remove();
            
            // Add new preview after file input
            $('.custom-file').after(previewHtml);
        }
         function downloadPreviewFileEdit(filePath) {
            if (filePath) {
                var cleanPath = filePath.replace(/^public\//, '');
                var downloadUrl = '/storage/' + cleanPath;
                window.open(downloadUrl, '_blank');
            }
        }
       
    })
//         function downloadPreviewFile(filePath) {
//             if (filePath) {
//                 var cleanPath = filePath.replace(/^public\//, '');
//                 var downloadUrl = '/storage/' + cleanPath;
//                 window.open(downloadUrl, '_blank');
//             }
//         }

//    $(document).ready(function(){
     
//    })

</script>
@endpush