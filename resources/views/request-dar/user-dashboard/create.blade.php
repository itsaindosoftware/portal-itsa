<div class="modal fade" tabindex="-1" id="create-reqdar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title create">FORM PERMOHONAN DOKUMEN ACTION / REQUEST FORM (DAR)</h5>
                {{-- <p id="by_add"></p> --}}
                <button type="button" onclick="" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="reqdarForm" method="POST" action="{{ route('requestdar.store') }}" enctype="multipart/form-data">
                    @csrf

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
                                                <input type="radio" class="custom-control-input" name="typereqform_id" id="type_{{ $type->id }}" value="{{ $type->id }}" required>
                                                <label class="custom-control-label" for="type_{{ $type->id }}">{{ $type->request_type }}</label>
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
                                                <input type="radio" class="custom-control-input" name="request_desc_id" id="request-desc-id_{{ $desc->id }}" value="{{ $desc->id }}" required>
                                                <label class="custom-control-label" for="request-desc-id_{{ $desc->id }}">{{ $desc->request_descript }}</label>
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
                                        <select class="form-control" name="dept_id" id="dept-id" required>
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
                                        <input type="text" class="form-control" name="no_doc" id="no-doc" placeholder="Tekan Enter / Masukkan nomor dokumen" required>
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
                                        <input type="text" class="form-control" name="name_doc" id="name-doc" placeholder="Masukkan nama dokumen" required>
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
                                        <input type="number" class="form-control" name="qty_pages" id="qty-pages" min="1" placeholder="Masukkan jumlah halaman" required>
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
                                            <input type="number" class="form-control" name="rev_no_before" id="rev_no_before" required placeholder="Rev No.">
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
                                            <input type="number" class="form-control" name="rev_no_after" id="rev_no_after" placeholder="Disi Oleh Syd" readonly>
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
                                            <textarea class="form-control" id="reason" name="reason" rows="3" placeholder="Jelaskan alasan perubahan dokumen" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
                                        </div>
                                    </div>
                                </div>

                               
                            </div>
                    </fieldset>

                    <!-- Fieldset untuk Alasan dan Detail Tambahan -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-primary font-weight-bold h6">Alasan & Detail Tambahan</legend>
                        <div class="row">
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Umur Penyimpanan</label>
                                    <div class="d-flex">
                                        <div class="d-flex align-items-center">
                                            <div class="custom-control custom-radio mr-3">
                                                <input type="radio" class="custom-control-input" id="storage_type_month" name="storage_type" value="month" required>
                                                <label class="custom-control-label" for="storage_type_month">Bulan</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" id="storage_type_year" name="storage_type" value="year" required>
                                                <label class="custom-control-label" for="storage_type_year">Tahun</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Upload Document</label>
                                    <div class="custom-file">
                                        <input type="file"
                                        class="custom-file-input"
                                        id="file_doc"
                                        name="file_doc"
                                         accept=".pdf,.xlsx,.xls" required>
                                        <label class="custom-file-label" for="file_doc">Pilih file PDF/Excel</label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Format yang didukung: PDF (maks. 5MB), Excel .xlsx/.xls (maks. 10MB)
                                    </small>
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" onclick="closeModal()" class="btn btn-danger">
                    <i class="ti-close"></i> Close
                </button>
                <button type="button" class="btn btn-primary addrm">
                    <i class="ti-check"></i> Submit
                </button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Lookup Documents --}}
<div class="modal fade" tabindex="-1" id="document-lookup-modal" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="true">
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
                            @foreach ($reqTypes as $typeDoc)
                                <option value="{{ $typeDoc->id }}">{{ $typeDoc->request_type }}</option>
                            @endforeach
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
                    <table class="table table-hover table-striped table-bordered" id="document-table">
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
        // document.addEventListener('DOMContentLoaded', function() {
        //     const fileInput = document.querySelector('.custom-file-input');
        //     if (fileInput) {
        //         fileInput.addEventListener('change', function(e) {
        //             var fileName = this.files[0].name;
        //             var nextSibling = this.nextElementSibling;
        //             nextSibling.innerText = fileName;
        //         });
        //     }
        // });
    $(document).ready(function(){
       $('#no-doc').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                openDocumentLookup();
            }
        });
        let lookupData;
        function openDocumentLookup() {
            $('#document-lookup-modal').appendTo('body').modal('show');

            if ($.fn.DataTable.isDataTable('#document-table')) {
                lookupData = $('#document-table').DataTable();
                lookupData.ajax.reload();
            } else {
                lookupData = $('#document-table').DataTable({
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
                $('#document-table tbody').on('click', 'tr', function () {
                    var data = lookupData.row(this).data();
                    console.log(data)
                    var match = data.title.match(/^([A-Z]{2}-\d{2}-\d{3})\s+(.+)$/);
                    // console.log(match)
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

                    $('#document-lookup-modal').modal('hide');
                });
            }
        }

           $('#filter-type').on('change', function() {
                 $('#document-table').DataTable().ajax.reload();
            });

            $('#document-lookup-modal').on('hidden.bs.modal', function () {
                if ($('.modal.show').length > 0) {
                    $('body').addClass('modal-open'); // menjaga scroll modal utama
                }
            });

    })
    

    function closeModal(){
        $('#create-reqdar').modal('hide');
        $('#reqdarForm')[0].reset();
        $('input[name="typereqform_id"]').prop('checked', false);
        // $('input[name="storage_type"]').prop('checked', false);
        $('input[name="request_desc_id"]').prop('checked', false);
    }



</script>
@endpush
