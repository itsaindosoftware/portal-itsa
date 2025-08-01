<div class="modal fade" tabindex="-1" id="edit-reqdar" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title edit">EDIT REQUEST DAR</h5>
                <p id="by_add"></p>
                <button type="button" onclick="" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                {{-- @role('user-employee') --}}
                <form id="reqdarFormEdit" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id-reqdar-form">
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-primary font-weight-bold h6">Informasi Approval</legend>

                        <!-- Progress Bar Status Approval -->
                        <div class="approval-progress mb-4">
                            <div class="progress" style="height: 8px;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
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
                                    <i class="fa fa-long-arrow-alt-right text-primary fa-2x"></i>
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
                                    <i class="fa fa-long-arrow-alt-right text-primary fa-2x"></i>
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
                                            <p class="font-weight-bold" id="approved-by1-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date1-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p >
                                                <span class="badge badge-success p-2" id="approval-status1-edit">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval1-edit"></p>
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
                                            <p class="font-weight-bold" id="approved-by2-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date2-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p>
                                                <span class="badge badge-success" id="approval-status2-edit">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval2-edit"></p>
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
                                            <p class="font-weight-bold" id="approved-by3-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Approval Date</label>
                                            <p class="font-weight-bold" id="approval-date3-edit"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="text-muted">Status</label>
                                            <p>
                                                <span class="badge badge-success p-2" id="approval-status3-edit">
                                                </span>
                                            </p>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Remarks</label>
                                            <p class="font-weight-bold" id="remark-approval3-edit"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!-- Fieldset untuk Request Type dan Description -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-primary font-weight-bold h6">Tipe & Deskripsi Permintaan</legend>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="request_type" class="font-weight-bold">Request Type</label>
                                    <div class="row mt-2">
                                        @foreach($reqTypes as $type)
                                        <div class="col-md-4 mb-2">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="typereqform_id" id="type_{{ $type->id }}_edit" value="{{ $type->id }}" required>
                                                <label class="custom-control-label" for="type_{{ $type->id }}_edit">{{ $type->request_type }}</label>
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
                                                <input type="radio" class="custom-control-input" name="request_desc_id" id="request-desc-id_{{ $desc->id }}_edit" value="{{ $desc->id }}" required>
                                                <label class="custom-control-label" for="request-desc-id_{{ $desc->id }}_edit">{{ $desc->request_descript }}</label>
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
                        <legend class="w-auto px-2 text-primary font-weight-bold h6">Informasi Dokumen</legend>
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Dari Department/Bagian</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-building"></i></span>
                                        </div>
                                        <select class="form-control" name="dept_id" id="dept-id-edit" required>
                                            <option value="">Pilih Department</option>
                                            @foreach($department as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div> --}}
                             <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nomor Dokumen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="no_doc" id="no-doc-edit" placeholder="Masukkan nomor dokumen" required>
                                    </div>
                                    <small class="form-text text-muted ml-1">
                                        <i class="fa fa-info-circle mr-1"></i>Tekan <strong>Enter</strong> untuk mencari dokumen
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Dokumen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-file"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="name_doc" id="name-doc-edit" placeholder="Masukkan nama dokumen" required>
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
                                        <input type="number" class="form-control" name="qty_pages" id="qty-pages-edit" min="1" placeholder="Masukkan jumlah halaman" required>
                                    </div>
                                </div>
                            </div>
                              <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Rev No Before</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="rev_no_before" id="rev_no_before_edit" required placeholder="Rev No Before.">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Rev No After</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="rev_no_after" readonly id="rev_no_after_edit" required placeholder="Rev No After.">
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
                                            <textarea class="form-control" id="reason-edit" name="reason" rows="3" placeholder="Jelaskan alasan perubahan dokumen" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
                                        </div>
                                    </div>
                                </div>

                              
                            </div>
                    </fieldset>

                    <!-- Fieldset untuk Alasan dan Detail Tambahan -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-primary font-weight-bold h6">Alasan & Detail Tambahan</legend>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Umur Penyimpanan</label>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-radio mr-3">
                                                <input type="radio" class="custom-control-input" id="storage_type_month_edit" name="storage_type" value="month" required>
                                                <label class="custom-control-label" for="storage_type_month_edit">Bulan</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="storage_type_year_edit" name="storage_type" value="year" required>
                                                <label class="custom-control-label" for="storage_type_year_edit">Tahun</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                           <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Upload Document</label>
                                    <div class="custom-file">
                                        <input type="hidden" id="file-storage">
                                        <input type="file" class="custom-file-input-edit" id="file_doc_edit" name="file_doc" accept=".pdf">
                                        <label class="custom-file-label-edit" for="file_doc">Pilih file PDF/Excel</label>
                                    </div>
                                    <small class="form-text text-muted">Format yang diterima: PDF. Maksimal ukuran: 5MB, Excel Maksimal ukuran: 10mb</small>
                                    <!-- Tambahkan tombol view PDF -->
                                   <div class="mt-2">
                                    <button type="button" id="view-pdf-btn" class="btn btn-sm btn-primary" disabled>
                                        <i class="fa fa-eye"></i> Lihat File
                                    </button>
                                    <span class="text-muted ml-2" id="pdf-file-name"></span>
                                </div>
                                <input type="hidden" id="file-doc-path" name="file_doc_path">
                                </div>
                            </div>
                        </div>
                        </div>


                    </fieldset>
                </form>
                {{-- @endrole --}}

                <div class="modal-footer bg-light">
                <button type="button" class="btn btn-info editfrm">
                    <i class="ti-check"></i> Update
                </button>
                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="ti-close"></i> Close
                </button>
                </div>
            </div>
            {{-- <div class="modal-footer">


            </div> --}}
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="document-lookup-edit" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">
                    <i class="fa fa-search mr-2"></i>Lookup Dokumen
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Search Filter -->
                <div class="row mb-3">
                    <div class="col-md-8">
                         <select class="form-control" id="filter-type">
                            <option value="">Semua Tipe</option>
                            <option value="workinstruction">Work Instruction</option>
                            <option value="procedure">Procedure</option>
                        </select>
                        {{-- <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-search"></i></span>
                            </div>
                            <input type="text" class="form-control" id="search-document" placeholder="Cari berdasarkan nomor atau nama dokumen...">
                        </div> --}}
                    </div>
                    {{-- <div class="col-md-4">
                        <select class="form-control" id="filter-type">
                            <option value="">Semua Tipe</option>
                            <option value="workinstruction">Work Instruction</option>
                            <option value="procedure">Procedure</option>
                        </select>
                    </div> --}}
                </div>

                <!-- Loading Indicator -->
                <div id="loading-lookup" class="text-center" style="display: none;">
                    <div class="spinner-border text-primary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    <p class="mt-2">Mencari dokumen...</p>
                </div>
                <div class="mb-2">
                <small class="text-muted">
                    <i class="fa fa-info-circle text-primary mr-1"></i>
                    Pilih data dan klik pada datanya untuk memilih dokumen.
                </small>
            </div>
                <!-- Document Table -->
                <div class="table-responsive">
                    <table class="table table-hover table-striped table-bordered" id="document-table-edit">
                        <thead class="thead-light">
                            <tr>
                                <th width="5%">#</th>
                                <th width="20%">Title</th>
                                <th width="35%">Description</th>
                                <th width="10%">Type Documents</th>
                                {{-- <th width="10%">Aksi</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan di-load via JavaScript -->
                        </tbody>
                    </table>
                </div>

                <!-- No Data Message -->
                <div id="no-data-message" class="text-center py-4" style="display: none;">
                    <i class="fa fa-folder-open fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Tidak ada dokumen yang ditemukan</p>
                </div>

                <!-- Pagination -->
                <nav aria-label="Document pagination" id="pagination-container" style="display: none;">
                    <ul class="pagination justify-content-center" id="pagination">
                        <!-- Pagination akan di-generate via JavaScript -->
                    </ul>
                </nav>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fa fa-times mr-1"></i>Close
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Script for file input -->
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.custom-file-input-edit');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                var fileName = this.files[0].name;
                var nextSibling = this.nextElementSibling;
                nextSibling.innerText = fileName;
            });
        }
    });

    $(document).ready(function(e){
        $('#no-doc-edit').on('keypress', function(e) {
            if (e.which == 13) {
                e.preventDefault();

                openDocumentLookupEdit();
            }
        });

       let lookupData;
       function openDocumentLookupEdit() {
            $('#document-lookup-edit').appendTo('body').modal('show');

            if ($.fn.DataTable.isDataTable('#document-table-edit')) {
                lookupData = $('#document-table-edit').DataTable();
                lookupData.ajax.reload();
            } else {
                lookupData = $('#document-table-edit').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: "{{ route('requestdar.lookupdokumen') }}",
                        data: function(d) {
                            d.filterType = $('#filter-type').val();
                        }
                    },
                    columns: [
                        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className:'text-center' },
                        { data: 'title', name: 'title' },
                        { data: 'description', name: 'description' },
                        { data: 'type_doc', name: 'type_doc' }
                    ],
                    bDestroy: true
                });

                // ONLY bind once!
                $('#document-table-edit tbody').on('click', 'tr', function () {
                    var data = lookupData.row(this).data();
                    var match = data.title.match(/^([A-Z]{2}-\d{2}-\d{3})\s+(.+)$/);

                    if (match) {
                        var noDoc = match[1];
                        var nameDocRaw = match[2];
                        var nameDoc = $('<textarea/>').html(nameDocRaw).text();
                         $('#no-doc-edit').val(noDoc);
                         $('#name-doc-edit').val(nameDoc);
                        
                    } else {
                        $('#no-doc-edit').val('');
                        $('#name-doc-edit').val('');
                    }

                    $('#document-lookup-edit').modal('hide');
                });
            }
        }

           $('#filter-type').on('change', function() {
                 $('#document-table-edit').DataTable().ajax.reload();
            });

            $('#document-lookup-edit').on('hidden.bs.modal', function () {
                if ($('.modal.show').length > 0) {
                    $('body').addClass('modal-open'); // menjaga scroll modal utama
                }
            });
    })


    $(document).on('click','#edit-data-dar', function(e){
        e.preventDefault();
        let id = $(this).data('id');
        let actionUrl = $(this).attr('href');
        let getApproveMgr = $(this).attr('row-approve-manager');
        let getApproveSysdev = $(this).attr('row-approve-sysdev');
        $('#approval-by1-edit').val(getApproveMgr);
        if (getApproveMgr != "" && getApproveSysdev != "") {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Data ini sudah diapprove oleh sysdev dan pimpinan anda, data ini tidak bisa di edit',
                showConfirmButton: true
            });
		//   $('#edit-reqdar').modal('hide');
        } else {
            EditDar(actionUrl)
        }

    });

    function EditDar(url){
        $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // console.log(response)
            // Set modal title with request number if available
            $('#edit-reqdar').modal('show');
            if (response.number_doc) {
                $('.modal-title.edit').text(`EDIT REQUEST DAR - ${response.number_doc}`);
            }
            $('#id-reqdar-form').val(response.reqdar_id);

            // Set requester information
            $('#by_add').text(`Requested by: ${response.name || 'N/A'}`);

            // Populate form fields with data
            // Type of request
            if (response.typereqform_id) {
                $(`#type_${response.typereqform_id}_edit`).prop('checked', true);
            }

            // Request description
            if (response.request_desc_id) {
                $(`#request-desc-id_${response.request_desc_id}_edit`).prop('checked', true);
            }

            // Department
            // $('#dept-id-edit').val(response.dept_id);

            // Document information
            $('#name-doc-edit').val(response.name_doc);
            $('#no-doc-edit').val(response.no_doc);
            $('#qty-pages-edit').val(response.qty_pages);
            $('#reason-edit').val(response.reason);
            $('#rev_no_before_edit').val(response.rev_no_before);
            $('#rev_no_after_edit').val(response.rev_no_after);
            // APPROVAL 1
            $('#approved-by1-edit').text(response.approval_by1);
            $('#approval-date1-edit').text(response.approval_date1);
            let approvalStatus1 = response.approval_status1 == '0' ? 'Waiting Approval' :
                                response.approval_status1 == '1' ? 'Approved' :
                                response.approval_status1 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status1-edit').text(approvalStatus1);
            $('#remark-approval1-edit').text(response.remark_approval_by1);
            // APPROVAL 2
            $('#approved-by2-edit').text(response.approval_by2);
            $('#approval-date2-edit').text(response.approval_date2);
            let approvalStatus2 = response.approval_status2 == '0' ? 'Waiting Approval' :
                                response.approval_status2 == '1' ? 'Approved' :
                                response.approval_status2 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status2-edit').text(approvalStatus2);
            $('#remark-approval2-edit').text(response.remark_approval_by2);
            // APPROVAL 3
            $('#approved-by3-edit').text(response.approval_by3);
            $('#approval-date3-edit').text(response.approval_date3);
            let approvalStatus3 = response.approval_status3 == '0' ? 'Waiting Approval' :
                                response.approval_status3 == '1' ? 'Approved' :
                                response.approval_status3 == '2' ? 'Rejected' :
                                'Unknown';
            $('#approval-status3-edit').text(approvalStatus3);
            $('#remark-approval3-edit').text(response.remark_approval_by3);

            $('#file-storage').val(response.file_doc);
            if (response.file_doc) {
                    const fileName = response.file_doc.split('/').pop();
                    $('.custom-file-label-edit').text(fileName);
                    $('#pdf-file-name').text(fileName);
                    $('#file-doc-path').val(response.file_doc);

                    // Enable tombol view PDF dan set document ID
                    $('#view-pdf-btn').data('document-id', response.reqdar_id);
                    $('#view-pdf-btn').prop('disabled', false);
                    updateViewButton(fileName);
            } else {
                $('#pdf-file-name').text('Tidak ada file');
                $('#view-pdf-btn').prop('disabled', true);
            }





                // Storage type
            if (response.storage_type === 'month') {
                $('#storage_type_month_edit').prop('checked', true);
            } else if (response.storage_type === 'year') {
                $('#storage_type_year_edit').prop('checked', true);
            }

            if (response.file_doc) {
                $('.custom-file-label-edit').text(response.file_doc.split('/').pop());
            }
            let currentPdfPath = '';

            if (response.file_doc) {
                $('.custom-file-label-edit').text(response.file_doc.split('/').pop());
                // Simpan ID dokumen untuk digunakan oleh tombol view PDF
                $('#view-pdf-btn').data('document-id', response.reqdar_id);

                // Aktifkan atau nonaktifkan tombol berdasarkan keberadaan file
                if (response.file_doc) {
                    $('#view-pdf-btn').prop('disabled', false);
                } else {
                    $('#view-pdf-btn').prop('disabled', true);
                }
            }

            updateApprovalStatus(response);

            $('#reqdarForm input, #reqdarForm select, #reqdarForm textarea').prop('disabled', true);

            // Show the modal
            // $('#edit-reqdar').modal('show');
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
        $(document).on('click','.editfrm', function(){
            if (!validateFileSize('file_doc_edit', 10)) {
                return false;
            }
            let id = $('#id-reqdar-form').val();
            var route = "{{ route('requestdar.update', ':param') }}";
            route_replace = route.replace(':param', id);
            // alert(id)
            var formData = new FormData($('#reqdarFormEdit')[0]);

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
                            $('#edit-reqdar').modal('hide')
                            $('#table-request-manage').DataTable().ajax.reload();
                        });

                } else {
                    alert('error')
                }
                }
            });
        })
        // $(document).on('click', '#view-pdf-btn', function() {
        //     const documentId = $(this).data('document-id');
        //     let urlFiledoc = $('#file-storage').val();
        //     alert(urlFiledoc)
        //     if (documentId) {
        //         window.open(`${window.location.origin}/${urlFiledoc}`, '_blank');
        //     } else {
        //         alert('Tidak ada dokumen PDF yang tersedia');
        //     }
        // });
    $(document).on('click', '#view-pdf-btn', function() {
        const documentId = $(this).data('document-id');
        let urlFiledoc = $('#file-storage').val();

        // alert(urlFiledoc)
        if (documentId  && urlFiledoc ) {
            // Set URL dan tampilkan modal
            const fileExtension = urlFiledoc.split('.').pop().toLowerCase();
            const excelExtensions = ['xlsx', 'xls', 'xlsm', 'xlsb', 'csv'];

            if (excelExtensions.includes(fileExtension)) {
                const downloadUrl = `${window.location.origin}/download-document/${documentId}`;
                const link = document.createElement('a');
                link.href = downloadUrl;
                link.download = ''; 
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            } else if(fileExtension == 'pdf'){
                const pdfUrl = `${window.location.origin}/view-document/${documentId}`;
                $('#pdf-viewer-iframe').attr('src', pdfUrl);

                const downloadUrl = `${window.location.origin}/download-document/${documentId}`;
                $('#download-pdf-btn').attr('href', downloadUrl);
                $('#pdf-viewer-modal').modal('show');
            }

       
        } else {
            alert('Tidak ada dokumen PDF/Excel yang tersedia');
        }
    });

        // Reset iframe saat modal ditutup
        $('#pdf-viewer-modal').on('hidden.bs.modal', function () {
            $('#pdf-viewer-iframe').attr('src', '');
        });
    
    function updateViewButton(fileName) {
        const fileExtension = fileName.split('.').pop().toLowerCase();
        const excelExtensions = ['xlsx', 'xls', 'xlsm', 'xlsb', 'csv'];
        
        if (excelExtensions.includes(fileExtension)) {
            $('#view-pdf-btn').html('<i class="fa fa-download"></i> Download File');
        } else if (fileExtension === 'pdf') {
            $('#view-pdf-btn').html('<i class="fa fa-eye"></i> Lihat File');
        } else {
            $('#view-pdf-btn').html('<i class="fa fa-download"></i> Download File');
        }
    }

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
    document.getElementById('file_doc_edit').addEventListener('change', function() {
        validateFileSize('file_doc_edit', 10); // 10mb
    });

    function closeDocumentModal() {
        $('#pdf-viewer-modal').modal('hide');
        setTimeout(function() {
            $('#edit-reqdar').modal('show');
            $('#edit-reqdar').css('overflow-y', 'auto');
        }, 300);
    }


</script>
@endpush
