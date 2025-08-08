<div class="modal fade" tabindex="-1" id="document-lookup-fromreq-modal" tabindex="-1" role="dialog" data-backdrop="false" data-keyboard="true">
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
                    <table class="table table-hover table-striped table-bordered" id="document-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>No Doc</th>
                                <th>Document Name</th>
                                <th>Departments</th>
                                <th>File Doc</th>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fa fa-times mr-1"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div>