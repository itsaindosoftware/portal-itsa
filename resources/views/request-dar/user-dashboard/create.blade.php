<div class="modal fade" tabindex="-1" id="create-reqdar">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title create">FORM PERMOHONAN DOKUMEN ACTION / REQUEST FORM (DAR)</h5>
                {{-- <p id="by_add"></p> --}}
                <button type="button" onclick="" class="close text-white" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="reqdarForm" method="POST" action="{{ route('requestdar.store') }}" enctype="multipart/form-data">
                    @csrf

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
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Informasi Dokumen</legend>
                        <div class="row">
                            <div class="col-md-6">
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
                                    <label class="font-weight-bold">Nomor Dokumen</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-id-badge"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="no_doc" id="no-doc" placeholder="Masukkan nomor dokumen" required>
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

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Rev No</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                            </div>
                                            <input type="number" class="form-control" name="rev_no" id="rev_no" required placeholder="Rev No.">
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
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Upload Document</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_doc" name="file_doc" accept=".pdf" required>
                                        <label class="custom-file-label" for="file_doc">Pilih file PDF</label>
                                    </div>
                                    <small class="form-text text-muted">Format yang diterima: PDF. Maksimal ukuran: 5MB</small>
                                </div>
                            </div>
                        </div>


                    </fieldset>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">
                    <i class="ti-close"></i> Tutup
                </button>
                <button type="button" class="btn btn-info addrm">
                    <i class="ti-check"></i> Submit
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

    function closeModal(){
        $('#create-reqdar').modal('hide');
        $('#reqdarForm')[0].reset();
        $('input[name="typereqform_id"]').prop('checked', false);
        $('input[name="storage_type"]').prop('checked', false);
        $('input[name="request_desc_id"]').prop('checked', false);
    }
    


</script>
@endpush
