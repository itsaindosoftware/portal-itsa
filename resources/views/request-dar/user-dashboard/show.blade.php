<div class="modal fade" tabindex="-1" id="view-reqdar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title view">INFORMASI DETAIL REQUEST DAR</h5>
                <p id="by_add"></p>
                <button type="button" onclick="" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="reqdarFormView" method="POST" action="" enctype="multipart/form-data">
                    {{-- @csrf --}}
                      <input type="hidden" id="id-reqdar-form-view">
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Informasi Approval</legend>

                        <!-- Progress Bar Status Approval -->
                        <div class="approval-progress mb-4">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar"
                                     style="width: 100%"
                                     aria-valuenow="100"
                                     aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                        <div class="approval-flow-container mb-3">
                            <div class="approval-flow d-flex justify-content-between">
                                <div class="approval-step text-center">
                                    <div class="approval-icon rounded-circle bg-success border d-flex justify-content-center align-items-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                        <i class="fa fa-user-tie fa-2x text-white"></i>
                                    </div>
                                    <h6 class="font-weight-bold">Manager</h6>
                                    {{-- <span class="badge badge-success">
                                       Pending
                                    </span> --}}
                                </div>
                                <div class="approval-arrow d-flex align-items-center">
                                    <i class="fa fa-long-arrow-alt-right text-info fa-2x"></i>
                                </div>
                                <div class="approval-step text-center">
                                    <div class="approval-icon rounded-circle bg-success border d-flex justify-content-center align-items-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                        <i class="fa fa-laptop-code fa-2x text-white"></i>
                                    </div>
                                    <h6 class="font-weight-bold">System Dev</h6>
                                    {{-- <span class="badge badge-success">
                                       Pending
                                    </span> --}}
                                </div>
                                <div class="approval-arrow d-flex align-items-center">
                                    <i class="fa fa-long-arrow-alt-right text-info fa-2x"></i>
                                </div>
                                <div class="approval-step text-center">
                                    <div class="approval-icon rounded-circle bg-success border d-flex justify-content-center align-items-center mx-auto mb-2" style="width: 60px; height: 60px;">
                                        <i class="fa fa-user-cog fa-2x text-white"></i>
                                    </div>
                                    <h6 class="font-weight-bold">Manager IT</h6>
                                    {{-- <span class="badge badge-success">
                                        Pending
                                    </span> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <!-- Approval 1 - Manager -->
                            <div class="col-md-4">
                                <div class="card border-left border-success border-danger">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="fa fa-user-tie mr-2"></i>Approval 1 (Manager)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="text-muted">Approved By</label>
                                            <p class="font-weight-bold" id="approved-by1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date1"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p >
                                                <span class="badge badge-success p-2" id="approval-status1">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval1"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approval 2 - System Dev -->
                            <div class="col-md-4">
                                <div class="card border-left border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="fa fa-laptop-code mr-2"></i>Approval 2 (Sys Dev)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="text-muted">Approved By</label>
                                            <p class="font-weight-bold" id="approved-by2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p>
                                                <span class="badge badge-success" id="approval-status2">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval2"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Approval 3 - Manager IT -->
                            <div class="col-md-4">
                                <div class="card border-left border-success">
                                    <div class="card-header bg-success text-white">
                                        <h6 class="mb-0"><i class="fa fa-user-cog mr-2"></i>Approval 3 (Manager IT)</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label class="text-muted">Approved By</label>
                                            <p class="font-weight-bold" id="approved-by3"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date3"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p>
                                                <span class="badge badge-success p-2" id="approval-status3">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval3"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Fieldset untuk Request Type dan Description -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Tipe & Deskripsi Permintaan</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="request_type" class="font-weight-bold">Request Type</label>
                                    <div class="row mt-2">
                                        @foreach($reqTypes as $type)
                                        <div class="col-md-4 mb-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="typereqform_id" id="type_{{ $type->id }}_view" value="{{ $type->id }}" required>
                                                <label class="custom-control-label" for="type_{{ $type->id }}_view">{{ $type->request_type }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="form-group mt-3">
                                    <label for="request_type" class="font-weight-bold">Description</label>
                                    <div class="row mt-2">
                                        @foreach($requestDesc as $desc)
                                        <div class="col-md-4 mb-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="request_desc_id" id="request-desc-id_{{ $desc->id }}_view" value="{{ $desc->id }}" required>
                                                <label class="custom-control-label" for="request-desc-id_{{ $desc->id }}_view">{{ $desc->request_descript }}</label>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Fieldset untuk Data Dokumen -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Informasi Dokumen</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Dari Department/Bagian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <select class="form-control" name="dept_id" id="dept-id-view" required>
                                            <option value="">Pilih Department</option>
                                            @foreach($department as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Dokumen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name_doc" id="name-doc-view" placeholder="Masukkan nama dokumen" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nomor Dokumen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="no_doc" id="no-doc-view" placeholder="Masukkan nomor dokumen" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Jumlah Halaman</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-list"></i></span>
                                        </div>
                                        <input type="number" class="form-control" name="qty_pages" id="qty-pages-view" min="1" placeholder="Masukkan jumlah halaman" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Alasan Perubahan Dokumen</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"  style="height: auto;">
                                                <span class="input-group-text" style="height: 100%; display: flex; align-items: center; border-top-right-radius: 0; border-bottom-right-radius: 0;"><i class="fa fa-pencil-alt"></i></span>
                                            </div>
                                            <textarea class="form-control" id="reason-view" name="reason" rows="3" placeholder="Jelaskan alasan perubahan dokumen" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Rev No</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="rev_no" id="rev_no_view" required placeholder="Rev No.">
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </fieldset>

                    <!-- Fieldset untuk Alasan dan Detail Tambahan -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Alasan & Detail Tambahan</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Umur Penyimpanan</label>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-radio mr-3">
                                                <input type="radio" class="custom-control-input" id="storage_type_month_view" name="storage_type" value="month" required>
                                                <label class="custom-control-label" for="storage_type_month_view">Bulan</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="storage_type_year_view" name="storage_type" value="year" required>
                                                <label class="custom-control-label" for="storage_type_year_view">Tahun</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Upload Document</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input-view" id="file_doc_view" name="file_doc" accept=".pdf" required>
                                        <label class="custom-file-label-view" for="file_doc">Pilih file PDF</label>
                                    </div>
                                    <small class="form-text text-muted">Format yang diterima: PDF. Maksimal ukuran: 5MB</small>
                                    <div class="mt-2">
                                        <button type="button" id="view-pdf-btn-view" class="btn btn-sm btn-primary">
                                            <i class="fa fa-eye"></i> Lihat PDF
                                        </button>
                                        <span class="text-muted ml-2" id="pdf-file-name-view"></span>
                                    </div>
                                    <input type="hidden" id="file-doc-path-view" name="file_doc_path">
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" onclick="" class="btn btn-secondary" data-dismiss="modal">
                    <i class="ti-close"></i> Tutup
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Script for file input -->
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.custom-file-input-view');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                var fileName = this.files[0].name;
                var nextSibling = this.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        }
    });


    $(document).on('click','#show-data-dar', function(e){
        e.preventDefault();
        $('#view-reqdar').modal('show');
        let id = $(this).data('id');
        let actionUrl = $(this).data('href');
        viewDetaildar(actionUrl)
    })

    function viewDetaildar(url){
        $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // console.log(response)
            // Set modal title with request number if available
            if (response.number_doc) {
                $('.modal-title.view').text(`INFORMASI DETAIL REQUEST DAR - ${response.number_doc}`);
            }

            // Set requester information
            $('#by_add').text(`Requested by: ${response.name || 'N/A'}`);

            // Populate form fields with data
            // Type of request
            if (response.typereqform_id) {
                $(`#type_${response.typereqform_id}_view`).prop('checked', true);
            }

            // Request description
            if (response.request_desc_id) {
                $(`#request-desc-id_${response.request_desc_id}_view`).prop('checked', true);
            }

            $('#id-reqdar-form-view').val(response.reqdar_id);

            // Department
            $('#dept-id-view').val(response.dept_id);

            // Document information
            $('#name-doc-view').val(response.name_doc);
            $('#no-doc-view').val(response.no_doc);
            $('#qty-pages-view').val(response.qty_pages);
            $('#reason-view').val(response.reason);
            $('#rev_no_view').val(response.rev_no);

            // APPROVAL 1
            $('#approved-by1').text(response.approval_by1);
            $('#approval-date1').text(response.approval_date1);
            let approvalStatus1 = response.approval_status1 == '0' ? 'Waiting Approval' :
                                response.approval_status1 == '1' ? 'Approved' :
                                response.approval_status1 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status1').text(approvalStatus1);
            $('#remark-approval1').text(response.remark_approval_by1);
            // APPROVAL 2
            $('#approved-by2').text(response.approval_by2);
            $('#approval-date2').text(response.approval_date2);
            let approvalStatus2 = response.approval_status2 == '0' ? 'Waiting Approval' :
                                response.approval_status2 == '1' ? 'Approved' :
                                response.approval_status2 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status2').text(approvalStatus2);
            $('#remark-approval2').text(response.remark_approval_by2);
            // APPROVAL 3
            $('#approved-by3').text(response.approval_by3);
            $('#approval-date3').text(response.approval_date3);
            let approvalStatus3 = response.approval_status3 == '0' ? 'Waiting Approval' :
                                response.approval_status3 == '1' ? 'Approved' :
                                response.approval_status3 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status3').text(approvalStatus3);
            $('#remark-approval3').text(response.remark_approval_by3);

            if (response.file_doc) {
                const fileName = response.file_doc.split('/').pop();
                $('.custom-file-label-view').text(fileName);
                $('#pdf-file-name-view').text(fileName);
                $('#file-doc-path-view').val(response.file_doc);
                
                // Enable tombol view PDF dan set document ID
                $('#-view-view').data('document-id', response.reqdar_id);
                $('#-view-view').prop('disabled', false);
            } else {
                $('#pdf-file-name-view').text('Tidak ada file');
                $('#-view-view').prop('disabled', true);
            }



                // Storage type
            if (response.storage_type === 'month') {
                $('#storage_type_month_view').prop('checked', true);
            } else if (response.storage_type === 'year') {
                $('#storage_type_year_view').prop('checked', true);
            }

            if (response.file_doc) {
                $('.custom-file-label-view').text(response.file_doc.split('/').pop());
            }

            updateApprovalStatus(response);

            $('#reqdarFormView input, #reqdarFormView select, #reqdarFormView textarea').prop('disabled', true);

            // Show the modal
            $('#view-reqdar').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle error
            console.error('Error fetching DAR details:', error);
            alert('Failed to load request details. Please try again.');
        }
    });

    }
    function updateApprovalStatus(data) {
        // Reset all approval elements to default
        const approvalCards = [
            { level: 'Manager', index: 1 },
            { level: 'Sys Dev', index: 2 },
            { level: 'Manager IT', index: 3 }
        ];
        
        // Progress bar calculation
        let approvedCount = 0;
        let progressPercentage = 0;
        if (data.approval_status1 === '1' && data.approval_status2 === '0' && data.approval_status3 === '0') {
            progressPercentage = 30;
        } else if (data.approval_status1 === '1' && data.approval_status2 === '1'  && data.approval_status3 === '0') {
             progressPercentage = 60;
        } else if (data.approval_status1 === '1' && data.approval_status2 === '1'  && data.approval_status3 === '1') {
            progressPercentage = 100;
        }
        // Manager Approval (Level 1)
        if (data.approval_by1) {
            approvedCount++;
            updateApprovalCard(1, {
                name: data.approval_by1,
                date: formatDate(data.approval_date1),
                status: data.approval_status1,
                remarks: data.remark_approval_by1 || 'Tidak ada catatan'
            });
        }
        
        // System Dev Approval (Level 2)
        if (data.approval_by2) {
            approvedCount++;
            updateApprovalCard(2, {
                name: data.approval_by2,
                date: formatDate(data.approval_date2),
                status: data.approval_status2,
                remarks: data.remark_approval_by2 || 'Tidak ada catatan'
            });
        }
        
        // Manager IT Approval (Level 3)
        if (data.approval_by3) {
            approvedCount++;
            updateApprovalCard(3, {
                name: data.approval_by3,
                date: formatDate(data.approval_date3),
                status: data.approval_status3,
                remarks: data.remark_approval_by3 || 'Tidak ada catatan'
            });
        }
        
        // Update progress bar
        // const progressPercentage = (approvedCount / totalApprovals) * 100;
        // $('.progress-bar').css('width', `${progressPercentage}%`);
        // $('.progress-bar').attr('aria-valuenow', progressPercentage);
        $('.progress-bar').css('width', `${progressPercentage}%`);
        $('.progress-bar').attr('aria-valuenow', progressPercentage);
    }
    function updateApprovalCard(level, data) {
        // console.log(data)
        const card = $(`.col-md-4:nth-child(${level}) .card`);
        const statusBadge = card.find('.badge');
        
        // Update approver name
        card.find('label:contains("Approved By")').next().text(data.name);
        
        // Update approval date
        card.find('label:contains("Approval Date")').next().text(data.date);
        
        // Update status badge
        statusBadge.removeClass('badge-success badge-danger badge-warning');
        
        if (data.status === '1') {
            statusBadge.addClass('badge-success').text('Approved');
            card.removeClass('border-danger').addClass('border-success');
            card.find('.card-header').removeClass('bg-danger').addClass('bg-success');
        } else if (data.status === '2') {
            statusBadge.addClass('badge-danger').text('Rejected');
            card.removeClass('border-success').addClass('border-danger');
            card.find('.card-header').removeClass('bg-success').addClass('bg-danger');
        } else {
            statusBadge.addClass('badge-warning').text('Waiting Approval');
        }
        // Update remarks
        card.find('label:contains("Remarks")').next().text(data.remarks);
      }
      function formatDate(dateString) {
            if (!dateString) return 'Belum ada tanggal';
            
            const date = new Date(dateString);
            if (isNaN(date.getTime())) return dateString; // Return original if invalid
                    
            return new Intl.DateTimeFormat('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }).format(date);
        }
    $(document).on('click', '#view-pdf-btn-view', function() {
        const documentId =  $('#id-reqdar-form-view').val();
        // alert(documentId)
        if (documentId) {
            // Set URL dan tampilkan modal
            const pdfUrl = `${window.location.origin}/view-document/${documentId}`;
            $('#pdf-viewer-iframe-view').attr('src', pdfUrl);
            $('#download-pdf-btn-view').attr('href', pdfUrl);
            $('#pdf-viewer-modal-view').modal('show');
        } else {
            alert('Tidak ada dokumen PDF yang tersedia');
        }
        });
        
        // Reset iframe saat modal ditutup
        $('#pdf-viewer-modal-view').on('hidden.bs.modal', function () {
            $('#pdf-viewer-iframe-view').attr('src', '');
        });
        function closeDocumentModalview() {
        $('#pdf-viewer-modal-view').modal('hide');
        setTimeout(function() {
            $('#view-reqdar').modal('show');
            $('#view-reqdar').css('overflow-y', 'auto');
        }, 300);
    }


</script>
@endpush
