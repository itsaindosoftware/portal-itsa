{{-- index.blade.php --}}
@extends('layouts.app_custom')
@section('title-head','Document Control Tracking')

@section('title','Document Control Tracking')

@section('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/Datatables/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/custom-edit.css') }}">
<style>
.dashboard-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 10px;
    transition: transform 0.2s;
}

.dashboard-card:hover {
    transform: translateY(-2px);
}

.status-card {
    border-radius: 8px;
    border-left: 4px solid;
    transition: all 0.2s;
}

.status-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.status-pending { border-left-color: #6c757d; }
.status-distributed { border-left-color: #17a2b8; }
.status-received { border-left-color: #28a745; }
.status-returned { border-left-color: #007bff; }
.status-overdue { border-left-color: #dc3545; }

.filter-card {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
}

/* ===== MODAL FIXES ===== */
/* Pastikan modal backdrop tidak hitam */
.modal-backdrop {
    background-color: rgba(0, 0, 0, 0.5) !important;
    z-index: 1040 !important;
}

/* Modal container */
.modal {
    z-index: 1050 !important;
    background-color: transparent !important;
}

/* Modal dialog */
.modal-dialog {
    z-index: 1051 !important;
    margin: 30px auto !important;
    max-width: 90% !important;
}

/* Modal content - pastikan background putih dan visible */
.modal-content {
    background-color: #ffffff !important;
    border: 1px solid rgba(0, 0, 0, 0.2) !important;
    border-radius: 6px !important;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3) !important;
    color: #333333 !important;
    position: relative !important;
    z-index: 1052 !important;
}

/* Modal header */
.modal-header {
    background-color: #f8f9fa !important;
    border-bottom: 1px solid #dee2e6 !important;
    color: #333333 !important;
    padding: 15px 20px !important;
}

.modal-header .modal-title {
    color: #333333 !important;
    font-weight: 600 !important;
    margin: 0 !important;
}

.modal-header .close {
    color: #333333 !important;
    opacity: 0.7 !important;
    font-size: 24px !important;
    font-weight: bold !important;
    text-shadow: none !important;
}

.modal-header .close:hover {
    color: #000000 !important;
    opacity: 1 !important;
}

/* Modal body */
.modal-body {
    background-color: #ffffff !important;
    color: #333333 !important;
    padding: 20px !important;
    max-height: 70vh !important;
    overflow-y: auto !important;
}

/* Modal footer */
.modal-footer {
    background-color: #f8f9fa !important;
    border-top: 1px solid #dee2e6 !important;
    padding: 15px 20px !important;
}

/* Form elements dalam modal */
.modal .form-control {
    background-color: #ffffff !important;
    border: 1px solid #ced4da !important;
    color: #333333 !important;
}

.modal .form-control:focus {
    background-color: #ffffff !important;
    border-color: #80bdff !important;
    color: #333333 !important;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25) !important;
}

.modal .form-group label {
    color: #333333 !important;
    font-weight: 500 !important;
}

/* Table dalam modal */
.modal .table {
    color: #333333 !important;
    background-color: transparent !important;
}

.modal .table td,
.modal .table th {
    border-color: #dee2e6 !important;
    color: #333333 !important;
}

.modal .table-sm td,
.modal .table-sm th {
    padding: 8px !important;
}

/* Badge dalam modal */
.modal .badge {
    color: #ffffff !important;
}

/* Timeline styles untuk history modal */
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 0;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 10px;
    color: #ffffff;
}

.timeline-content {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 15px;
    border-left: 3px solid #dee2e6;
}

.timeline-header h6 {
    color: #333333 !important;
    margin-bottom: 5px;
}

.timeline-body {
    color: #666666 !important;
}

.timeline-body p {
    color: #666666 !important;
    margin-bottom: 8px;
}

.timeline-line {
    position: absolute;
    left: -26px;
    top: 25px;
    bottom: -15px;
    width: 2px;
    background: #dee2e6;
}

/* Loading spinner dalam modal */
.modal .fa-spin {
    color: #007bff !important;
}

/* Text colors dalam modal */
.modal .text-muted {
    color: #6c757d !important;
}

.modal .text-danger {
    color: #dc3545 !important;
}

.modal .text-center {
    text-align: center !important;
}

/* Button styles dalam modal */
.modal .btn {
    font-weight: 500;
}

/* Responsive modal */
@media (max-width: 576px) {
    .modal-dialog {
        margin: 10px !important;
        max-width: 95% !important;
    }
    
    .modal-content {
        margin: 0 !important;
    }
    
    .modal-body {
        padding: 15px !important;
    }
}

/* Large modal khusus */
.modal-lg {
    max-width: 800px !important;
}

/* Pastikan tidak ada overlay hitam lainnya */
body.modal-open {
    padding-right: 0 !important;
    overflow: hidden;
}

/* Fix untuk dropdown dalam modal jika ada */
.modal .dropdown-menu {
    background-color: #ffffff !important;
    border: 1px solid #dee2e6 !important;
    color: #333333 !important;
    z-index: 1055 !important;
}

.modal .dropdown-item {
    color: #333333 !important;
}

.modal .dropdown-item:hover {
    background-color: #f8f9fa !important;
    color: #333333 !important;
}

/* Pastikan select dalam modal terlihat */
.modal select.form-control {
    background-color: #ffffff !important;
    color: #333333 !important;
    border: 1px solid #ced4da !important;
}

/* Textarea dalam modal */
.modal textarea.form-control {
    background-color: #ffffff !important;
    color: #333333 !important;
    border: 1px solid #ced4da !important;
    resize: vertical !important;
}

/* Required field indicator */
.modal .text-danger {
    color: #dc3545 !important;
}

/* Success/Error messages dalam modal */
.modal .alert {
    background-color: transparent;
    border-radius: 6px;
    margin-bottom: 15px;
}

.modal .alert-success {
    background-color: #d4edda !important;
    border-color: #c3e6cb !important;
    color: #155724 !important;
}

.modal .alert-danger {
    background-color: #f8d7da !important;
    border-color: #f5c6cb !important;
    color: #721c24 !important;
}

/* Khusus untuk prevent modal hitam di beberapa theme */
.modal.show .modal-dialog {
    transform: none !important;
}

.modal.fade .modal-dialog {
    transition: transform 0.3s ease-out !important;
    transform: translate(0, -50px) !important;
}

.modal.show .modal-dialog {
    transform: none !important;
}
.controlled-distribution-form .table td, 
.controlled-distribution-form .table th {
    vertical-align: middle;
    font-size: 11px;
}

.signature-cell {
    height: 40px;
    position: relative;
}

.signature-display {
    font-size: 18px;
    color: #007bff;
    font-weight: bold;
}

.custom-checkbox {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
}

.custom-checkbox input[type="checkbox"] {
    transform: scale(1.3);
    margin: 0;
}

.dotted-line {
    border-bottom: 1px dotted #333;
    height: 20px;
}

.border-bottom {
    border-bottom: 1px dotted #333 !important;
}

.form-control-plaintext {
    background: none !important;
    border: none !important;
    padding: 0 !important;
}

.modal-xl {
    max-width: 1400px;
}

@media (max-width: 1200px) {
    .modal-xl {
        max-width: 95%;
    }
}
</style>
@endsection

@section('content')
<div class="container-fluid">
    {{-- Dashboard Summary --}}
    @role('sysdev')
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card dashboard-card">
                <div class="card-body">
                    <h5 class="card-title mb-3">
                        <i class="fas fa-chart-pie mr-2"></i>
                        Dashboard Summary
                    </h5>
                    <div class="row" id="dashboard-summary">
                        {{-- Summary cards will be loaded here --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endrole

    {{-- Status Cards --}}
    @role('sysdev')
    <div class="row mb-4">
        <div class="col-md-2">
            <div class="card status-card status-pending">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-pending">-</div>
                    <small>Menunggu</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card status-card status-distributed">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-distributed">-</div>
                    <small>Didistribusi</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card status-card status-received">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-received">-</div>
                    <small>Diterima</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card status-card status-returned">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-returned">-</div>
                    <small>Dikembalikan</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card status-card status-overdue">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-overdue">-</div>
                    <small>Terlambat</small>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="card status-card" style="border-left-color: #343a40;">
                <div class="card-body text-center">
                    <div class="h4 mb-1" id="count-total">-</div>
                    <small>Total</small>
                </div>
            </div>
        </div>
    </div>
    @endrole
    {{-- Filters --}}
    <div class="row">
        <div class="col-md-12">
            <div class="filter-card">
                <div class="row">
                    @role('sysdev')
                    <div class="col-md-3">
                        <label>Departemen</label>
                        <select id="filter-department" class="form-control">
                            <option value="">Semua Departemen</option>
                            @foreach($departments as $dept)
                            <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endrole
                    @role('manager')
                    <div class="col-md-4">
                        <label>Status</label>
                        <select id="filter-status" class="form-control">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endrole
                    @role('sysdev')
                    <div class="col-md-4">
                        <label>Status</label>
                        <select id="filter-status" class="form-control">
                            <option value="">Semua Status</option>
                            @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endrole
                    <div class="col-md-2">
                        <label>Tanggal Mulai</label>
                        <input type="date" id="filter-start-date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>Tanggal Akhir</label>
                        <input type="date" id="filter-end-date" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label>&nbsp;</label>
                        <div>
                            <button type="button" class="btn btn-primary btn-block" onclick="applyFilters()">
                                <i class="fas fa-search"></i> Filter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Data Table --}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-list mr-2"></i>
                        Document Control Tracking
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover" id="docControlTable">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Informasi Dokumen</th>
                                    <th width="15%">Departemen</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Aktivitas Terakhir</th>
                                    <th width="10%">Waktu Berlalu</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-file-alt mr-2"></i>
                    PENGENDALIAN DISTRIBUSI DOKUMEN (CONTROLLED DISTRIBUTION)
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" id="detail-content">
                {{-- Content will be loaded here --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Tutup
                </button>
                <button type="button" class="btn btn-primary" onclick="printDocumentForm()">
                    <i class="fas fa-print mr-2"></i>Print
                </button>
            </div>
        </div>
    </div>
</div>
{{-- Modal Detail - Versi yang diperbaiki --}}
{{-- <div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">
                    <i class="fas fa-file-alt mr-2"></i>
                    Detail Dokumen
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="detail-content">
                {{-- Content will be loaded here --}}
            {{-- </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-2"></i>Tutup
                </button>
            </div>
        </div>
    </div>
</div> --}} 

{{-- Modal Mark Received --}}
<div class="modal fade" id="receivedModal" tabindex="-1" role="dialog" aria-labelledby="receivedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="receivedForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tandai Dokumen Diterima</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="received-distribution-id">
                    
                    <div class="form-group">
                        <label>Nama Penerima <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="receiver-name" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Posisi/Jabatan</label>
                        <input type="text" class="form-control" id="receiver-position">
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Diterima <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="received-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanda Tangan (Digital)</label>
                        <textarea class="form-control" id="receiver-signature" rows="3" 
                                  placeholder="Base64 signature atau path file"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" id="received-remarks" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Tandai Diterima
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Mark Returned --}}
<div class="modal fade" id="returnedModal" tabindex="-1" role="dialog" role="dialog" aria-labelledby="returnedModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="returnedForm">
                <div class="modal-header">
                    <h5 class="modal-title">Tandai Dokumen Dikembalikan</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="returned-distribution-id">
                    
                    <div class="form-group">
                        <label>Diterima Kembali Oleh <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="return-receiver" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Tanggal Dikembalikan <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="return-date" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Catatan</label>
                        <textarea class="form-control" id="return-remarks" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-undo"></i> Tandai Dikembalikan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal History --}}
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="historyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Riwayat Aktivitas Dokumen</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body" id="history-content">
                {{-- History content will be loaded here --}}
            </div>
        </div>
    </div>
</div>
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/Datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/Datatables/dataTables.bootstrap4.min.js') }}"></script>

<script>
let docControlTable;



$(document).ready(function() {
    // Initialize DataTable
    initDataTable();
    
    // Load dashboard data
    loadDashboardData();
    
    // Set default date to today
    $('#received-date, #return-date').val(new Date().toISOString().split('T')[0]);
    
    // Form submissions
    $('#receivedForm').on('submit', handleReceivedForm);
    $('#returnedForm').on('submit', handleReturnedForm);
});

function initDataTable() {
    docControlTable = $('#docControlTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("doccontroltrack.data") }}',
            data: function(d) {
                d.dept_id = $('#filter-department').val();
                d.status = $('#filter-status').val();
                d.start_date = $('#filter-start-date').val();
                d.end_date = $('#filter-end-date').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'document_info', name: 'document_info', orderable: false },
            { data: 'department_name', name: 'department.name' },
            { data: 'status_badge', name: 'current_status' },
            { data: 'last_activity', name: 'last_activity', orderable: false },
            { data: 'days_since', name: 'days_since', orderable: false },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ],
        order: [[3, 'desc']],
        pageLength: 25,
        responsive: true,
        // language: {
        //     url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        // }
    });
}
$(document).ready(function() {
    // Fix modal backdrop issue
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
    
    // Pastikan modal cleanup ketika ditutup
    $('.modal').on('hidden.bs.modal', function (e) {
        // Remove any lingering backdrops
        $('.modal-backdrop').remove();
        $('body').removeClass('modal-open');
        $('body').css('padding-right', '');
        
        // Clear modal content if needed
        if (this.id === 'detailModal') {
            $('#detail-content').empty();
        }
        if (this.id === 'historyModal') {
            $('#history-content').empty();
        }
    });
    
    // Pastikan modal show dengan benar
    $('.modal').on('show.bs.modal', function (e) {
        var modal = $(this);
        
        // Set z-index yang tepat
        modal.css('z-index', 1050);
        
        // Pastikan backdrop ada
        setTimeout(function() {
            if ($('.modal-backdrop').length === 0) {
                $('<div class="modal-backdrop fade show"></div>').appendTo(document.body);
            }
        }, 100);
    });
    
    // Handle multiple modals jika diperlukan
    $(document).on('show.bs.modal', '.modal', function () {
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function() {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    
    // Pastikan ketika modal ditutup, backdrop juga hilang
    $(document).on('hidden.bs.modal', '.modal', function () {
        if ($('.modal.show').length > 0) {
            // Still have modal opened
            $('body').addClass('modal-open');
        } else {
            // No more modal
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
        }
    });
});

// Function untuk membuka modal dengan aman
function openModal(modalId) {
    // Tutup modal lain terlebih dahulu
    $('.modal').modal('hide');
    
    // Tunggu sebentar lalu buka modal yang diinginkan
    setTimeout(function() {
        $('#' + modalId).modal('show');
    }, 300);
}

function loadDashboardData() {
    $.get('{{ route("doccontroltrack.dashboard") }}', function(data) {
        $('#count-total').text(data.total);
        $('#count-pending').text(data.pending);
        $('#count-distributed').text(data.distributed);
        $('#count-received').text(data.received);
        $('#count-returned').text(data.returned);
        $('#count-overdue').text(data.overdue);
    });
}

function applyFilters() {
    docControlTable.ajax.reload();
    loadDashboardData();
}

function viewDetail(id) {
    if (!id) {
        console.error('ID is required for viewDetail');
        return;
    }
    
    // Show loading dalam modal
    $('#detail-content').html(`
        <div class="text-center p-4">
            <i class="fas fa-spinner fa-spin fa-2x text-primary"></i>
            <p class="mt-2 text-muted">Memuat detail dokumen...</p>
        </div>
    `);
    openModal('detailModal');
    $.get('/doccontroltrack/' + id + '/history', function(data) {
        const content = generateDocumentControlForm(data);
        $('#detail-content').html(content);
    }).fail(function() {
        $('#detail-content').html(`
            <div class="text-center p-4">
                <i class="fas fa-exclamation-circle fa-3x text-danger mb-3"></i>
                <p class="text-danger">Gagal memuat detail dokumen</p>
            </div>
        `);
    });
}
function generateDocumentControlForm(data) {
    const document = data.document;
    const distributions = data.distributions;
    const effectiveDate = document.effective_date ? formatDate(document.effective_date) : '-';
    
    let html = `
        <div class="controlled-distribution-form">
            <!-- Form Header -->
            <div class="form-header bg-light border-bottom p-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">TYPE OF DOCUMENT:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control-plaintext border-bottom" value="${document.request_type}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">DOCUMENT NO / PART No:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control-plaintext border-bottom" value="${document.number}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-5 col-form-label font-weight-bold">DOCUMENT NAME / PART NAME:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control-plaintext border-bottom" value="${document.title}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="text-center border p-2">
                            <strong>CUSTOMER</strong>
                            <div class="dotted-line mt-2"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="font-weight-bold">REVISION:</label>
                            <input type="text" class="form-control" value="${document.revision}" readonly>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">EFF DATE:</label>
                            <input type="text" class="form-control" value="${effectiveDate}" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Distribution Table -->
            <div class="distribution-table p-3">
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th rowspan="2" class="text-center align-middle" style="width: 80px;">DEPARTMENT</th>
                            <th rowspan="2" class="text-center align-middle" style="width: 100px;">POSITION<br/>(RECEIVER)</th>
                            <th colspan="3" class="text-center">COPY</th>
                            <th colspan="2" class="text-center">RECEIVER</th>
                            <th colspan="4" class="text-center">RETURN OUT-OF-DATE DOCUMENT</th>
                        </tr>
                        <tr>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th class="text-center" style="width: 50px;">QTY</th>
                            <th class="text-center" style="width: 100px;">SIGNATURE</th>
                            <th class="text-center" style="width: 80px;">DATE</th>
                            <th class="text-center" style="width: 50px;">YES</th>
                            <th class="text-center" style="width: 50px;">NO</th>
                            <th class="text-center" style="width: 100px;">RECEIVED BY</th>
                            <th class="text-center" style="width: 80px;">DATE</th>
                            <th class="text-center" style="width: 120px;">REMARK</th>
                        </tr>
                    </thead>
                    <tbody>`;

    // Generate rows for distributions
    distributions.forEach((dist, index) => {
        const receivedInfo = dist.received_info;
        const returnedInfo = dist.returned_info;
        const isReceived = dist.current_status === 'received' || dist.current_status === 'returned';
        const isReturned = dist.current_status === 'returned';
        
        html += `
            <tr>
                <td class="text-center font-weight-bold">${dist.department_code}</td>
                <td class="text-center small">${receivedInfo?.position || ''}</td>
                <td class="text-center">${index + 1}</td>
                <td class="text-center">1</td>
                <td class="text-center signature-cell">
                    ${receivedInfo?.signature ? '<div class="signature-display">✓</div>' : ''}
                </td>
                <td class="text-center small">
                    ${receivedInfo?.date ? formatDateShort(receivedInfo.date) : ''}
                </td>
                <td class="text-center">
                    <div class="custom-checkbox">
                        <input type="checkbox" ${isReturned ? 'checked' : ''} disabled>
                    </div>
                </td>
                <td class="text-center">
                    <div class="custom-checkbox">
                        <input type="checkbox" ${!isReturned && isReceived ? 'checked' : ''} disabled>
                    </div>
                </td>
                <td class="text-center small">${returnedInfo?.return_receiver || ''}</td>
                <td class="text-center small">
                    ${returnedInfo?.return_date ? formatDateShort(returnedInfo.return_date) : ''}
                </td>
                <td class="small">${returnedInfo?.remarks || ''}</td>
            </tr>`;
    });

    // Add empty rows to fill the form (minimum 15 rows total)
    const emptyRowsNeeded = Math.max(0, 15 - distributions.length);
    for (let i = 0; i < emptyRowsNeeded; i++) {
        html += `
            <tr>
                <td class="text-center">&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center">&nbsp;</td>
                <td class="text-center">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td class="text-center">
                    <div class="custom-checkbox">
                        <input type="checkbox" disabled>
                    </div>
                </td>
                <td class="text-center">
                    <div class="custom-checkbox">
                        <input type="checkbox" disabled>
                    </div>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>`;
    }

    html += `
                    </tbody>
                </table>
            </div>
        </div>`;

    return html;
}
function formatDateShort(dateString) {
    if (!dateString) return '';
    
    const date = new Date(dateString);
    const day = date.getDate().toString().padStart(2, '0');
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                   'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const month = months[date.getMonth()];
    const year = date.getFullYear().toString().slice(-2);
    
    return `${day}-${month}-${year}`;
}

function printDocumentForm() {
    const content = document.getElementById('detail-content').innerHTML;
    const printWindow = window.open('', '_blank');
    
    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Document Control Distribution Form</title>
            <style>
                body { font-family: Arial, sans-serif; font-size: 12px; margin: 20px; }
                .controlled-distribution-form { width: 100%; }
                .form-header { margin-bottom: 20px; }
                .form-group { margin-bottom: 10px; }
                .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
                .table th, .table td { 
                    border: 1px solid #000; 
                    padding: 4px; 
                    text-align: left; 
                    font-size: 10px;
                }
                .table th { background-color: #f0f0f0; font-weight: bold; }
                .text-center { text-align: center !important; }
                .font-weight-bold { font-weight: bold; }
                .signature-display { font-size: 16px; }
                .custom-checkbox input { transform: scale(1.2); }
                .border-bottom { border-bottom: 1px dotted #000; }
                .dotted-line { border-bottom: 1px dotted #000; height: 20px; }
                .form-control-plaintext { border: none; background: none; }
                .bg-light { background-color: #f8f9fa; }
                @media print {
                    body { margin: 0; }
                    .no-print { display: none; }
                }
            </style>
        </head>
        <body>
            <div style="text-align: center; margin-bottom: 20px; border: 2px solid #000; padding: 10px;">
                <div style="float: left; margin-right: 20px;">
                    <div style="border: 1px solid #000; padding: 10px; width: 60px; height: 60px;">
                        <strong>LOGO</strong>
                    </div>
                </div>
                <div style="text-align: center;">
                    <h2 style="margin: 0;">PENGENDALIAN DISTRIBUSI DOKUMEN</h2>
                    <h3 style="margin: 0;">(CONTROLLED DISTRIBUTION)</h3>
                </div>
                <div style="float: right; border: 1px solid #000; padding: 10px; width: 80px; height: 60px; text-align: center;">
                    <strong>FORM B</strong>
                </div>
                <div style="clear: both;"></div>
            </div>
            ${content}
        </body>
        </html>
    `);
    
    printWindow.document.close();
    setTimeout(() => {
        printWindow.print();
        printWindow.close();
    }, 250);
}
function loadRecentActivities(id) {
    $.get('/doccontroltrack/' + id+'/history', function(data) {
        let html = '';
        if (data.length > 0) {
            data.slice(0, 5).forEach(function(log) {
                html += `
                    <div class="border-left border-${getActionColor(log.action_type)} pl-3 mb-2">
                        <small class="text-muted">${formatDate(log.created_at)}</small><br>
                        <strong>${getActionText(log.action_type)}</strong><br>
                        <small>${log.creator?.name || 'System'}</small>
                    </div>
                `;
            });
        } else {
            html = '<div class="text-muted text-center">Belum ada aktivitas</div>';
        }
        $('#recent-activities').html(html);
    });
}

function markReceived(id) {
    if (!id) {
        console.error('ID is required for markReceived');
        return;
    }
    $('#received-distribution-id').val(id);
    $('#receivedForm')[0].reset();
    
    // Set default date
    $('#received-date').val(new Date().toISOString().split('T')[0]);
    
    openModal('receivedModal');
    // $('#received-distribution-id').val(id);
    // $('#receivedModal').modal('show');
}

function markReturned(id) {
    if (!id) {
        console.error('ID is required for markReturned');
        return;
    }
    // $('#returned-distribution-id').val(id);
    // $('#returnedModal').modal('show');
    $('#returned-distribution-id').val(id);
    $('#returnedForm')[0].reset();
    
    // Set default date
    $('#return-date').val(new Date().toISOString().split('T')[0]);
    
    openModal('returnedModal');
}

function handleReceivedForm(e) {
    e.preventDefault();
    
    const id = $('#received-distribution-id').val();
    const data = {
        receiver_name: $('#receiver-name').val(),
        position: $('#receiver-position').val(),
        action_date: $('#received-date').val(),
        receiver_signature: $('#receiver-signature').val(),
        remarks: $('#received-remarks').val(),
        _token: '{{ csrf_token() }}'
    };
    
    $.post('/doccontroltrack/mark-received/' + id, data)
        .done(function(response) {
            if (response.success) {
                $('#receivedModal').modal('hide');
                $('#receivedForm')[0].reset();
                docControlTable.ajax.reload();
                loadDashboardData();
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        })
        .fail(function(xhr) {
            let errorMessage = 'Terjadi kesalahan';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage
            });
        });
}

function handleReturnedForm(e) {
    e.preventDefault();
    
    const id = $('#returned-distribution-id').val();
    const data = {
        return_receiver: $('#return-receiver').val(),
        return_date: $('#return-date').val(),
        remarks: $('#return-remarks').val(),
        _token: '{{ csrf_token() }}'
    };
    
    $.post('/doccontroltrack/mark-returned/' + id, data)
        .done(function(response) {
            if (response.success) {
                $('#returnedModal').modal('hide');
                $('#returnedForm')[0].reset();
                docControlTable.ajax.reload();
                loadDashboardData();
                
                // Show success message
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
            }
        })
        .fail(function(xhr) {
            let errorMessage = 'Terjadi kesalahan';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMessage = xhr.responseJSON.message;
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: errorMessage
            });
        });
}

function viewHistory(id) {
    if (!id) {
        console.error('ID is required for viewHistory');
        return;
    }
    $('#history-content').html(`
        <div class="text-center p-4">
            <i class="fas fa-spinner fa-spin fa-2x"></i>
            <p class="mt-2">Memuat riwayat...</p>
        </div>
    `);
    
    // $('#historyModal').modal('show');
    openModal('historyModal');
    
    $.get('/doccontroltrack/' + id + '/history')
        .done(function(data) {
            let html = '';
            
            if (data.length > 0) {
                html = '<div class="timeline">';
                
                data.forEach(function(log, index) {
                    const isLast = index === data.length - 1;
                    const actionColor = getActionColor(log.action_type);
                    const actionText = getActionText(log.action_type);
                    const actionIcon = getActionIcon(log.action_type);
                    
                    html += `
                        <div class="timeline-item">
                            <div class="timeline-marker bg-${actionColor}">
                                <i class="fas ${actionIcon}"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-header">
                                    <h6 class="mb-1">${actionText}</h6>
                                    <small class="text-muted">${formatDateTime(log.created_at)}</small>
                                </div>
                                <div class="timeline-body">
                                    ${getLogDetails(log)}
                                </div>
                            </div>
                            ${!isLast ? '<div class="timeline-line"></div>' : ''}
                        </div>
                    `;
                });
                
                html += '</div>';
            } else {
                html = `
                    <div class="text-center p-4">
                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Belum ada riwayat aktivitas untuk dokumen ini</p>
                    </div>
                `;
            }
            
            $('#history-content').html(html);
        })
        .fail(function() {
            $('#history-content').html(`
                <div class="text-center p-4">
                    <i class="fas fa-exclamation-circle fa-3x text-danger mb-3"></i>
                    <p class="text-danger">Gagal memuat riwayat aktivitas</p>
                </div>
            `);
        });
}

// Helper functions
function getStatusClass(status) {
    const statusClasses = {
        'pending': 'secondary',
        'distributed': 'info',
        'received': 'success',
        'returned': 'primary',
        'overdue': 'danger'
    };
    return statusClasses[status] || 'secondary';
}

function getStatusText(status) {
    const statusTexts = {
        'pending': 'Menunggu',
        'distributed': 'Didistribusi',
        'received': 'Diterima',
        'returned': 'Dikembalikan',
        'overdue': 'Terlambat'
    };
    return statusTexts[status] || status;
}

function getActionColor(actionType) {
    const actionColors = {
        'created': 'primary',
        'distributed': 'info',
        'received': 'success',
        'returned': 'warning',
        'updated': 'secondary'
    };
    return actionColors[actionType] || 'secondary';
}

function getActionText(actionType) {
    const actionTexts = {
        'created': 'Dokumen Dibuat',
        'distributed': 'Dokumen Didistribusi',
        'received': 'Dokumen Diterima',
        'returned': 'Dokumen Dikembalikan',
        'updated': 'Dokumen Diperbarui'
    };
    return actionTexts[actionType] || actionType;
}

function getActionIcon(actionType) {
    const actionIcons = {
        'created': 'fa-plus-circle',
        'distributed': 'fa-share',
        'received': 'fa-check-circle',
        'returned': 'fa-undo',
        'updated': 'fa-edit'
    };
    return actionIcons[actionType] || 'fa-circle';
}

function getLogDetails(log) {
    let details = '';
    
    if (log.creator && log.creator.name) {
        details += `<p class="mb-1"><strong>Oleh:</strong> ${log.creator.name}</p>`;
    }
    
    if (log.receiver_name) {
        details += `<p class="mb-1"><strong>Penerima:</strong> ${log.receiver_name}</p>`;
    }
    
    if (log.position) {
        details += `<p class="mb-1"><strong>Posisi:</strong> ${log.position}</p>`;
    }
    
    if (log.return_receiver) {
        details += `<p class="mb-1"><strong>Diterima kembali oleh:</strong> ${log.return_receiver}</p>`;
    }
    
    if (log.action_date && log.action_date !== log.created_at) {
        details += `<p class="mb-1"><strong>Tanggal Aksi:</strong> ${formatDate(log.action_date)}</p>`;
    }
    
    if (log.remarks) {
        details += `<p class="mb-0"><strong>Catatan:</strong> ${log.remarks}</p>`;
    }
    
    return details || '<p class="mb-0 text-muted">Tidak ada detail tambahan</p>';
}

function formatDate(dateString) {
    if (!dateString) return '-';
    
    const date = new Date(dateString);
    const options = { 
        year: 'numeric', 
        month: 'long', 
        day: 'numeric' 
    };
    
    return date.toLocaleDateString('id-ID', options);
}

function formatDateTime(dateString) {
    if (!dateString) return '-';
    
    const date = new Date(dateString);
    const dateOptions = { 
        year: 'numeric', 
        month: 'short', 
        day: 'numeric' 
    };
    const timeOptions = { 
        hour: '2-digit', 
        minute: '2-digit' 
    };
    
    return date.toLocaleDateString('id-ID', dateOptions) + ' ' + 
           date.toLocaleTimeString('id-ID', timeOptions);
}

// Reset filters
function resetFilters() {
    $('#filter-department').val('');
    $('#filter-status').val('');
    $('#filter-start-date').val('');
    $('#filter-end-date').val('');
    applyFilters();
}

// Export functions (if needed)
function exportToExcel() {
    const filters = {
        dept_id: $('#filter-department').val(),
        status: $('#filter-status').val(),
        start_date: $('#filter-start-date').val(),
        end_date: $('#filter-end-date').val()
    };
    
    const queryString = $.param(filters);
    window.open(`/doccontroltrack/export/excel?${queryString}`, '_blank');
}

function exportToPDF() {
    const filters = {
        dept_id: $('#filter-department').val(),
        status: $('#filter-status').val(),
        start_date: $('#filter-start-date').val(),
        end_date: $('#filter-end-date').val()
    };
    
    const queryString = $.param(filters);
    window.open(`/doccontroltrack/export/pdf?${queryString}`, '_blank');
}

// Auto refresh data every 5 minutes
setInterval(function() {
    loadDashboardData();
    if (docControlTable) {
        docControlTable.ajax.reload(null, false); // false to keep current page
    }
}, 300000); // 5 minutes

// Keyboard shortcuts
$(document).on('keydown', function(e) {
    // Ctrl + R for refresh
    if (e.ctrlKey && e.keyCode === 82) {
        e.preventDefault();
        applyFilters();
    }
    
    // Escape to close modals
    if (e.keyCode === 27) {
        $('.modal').modal('hide');
    }
});

// Print functionality
function printDocumentControl() {
    const printWindow = window.open('', '_blank');
    const currentDate = new Date().toLocaleDateString('id-ID');
    
    const printContent = `
        <!DOCTYPE html>
        <html>
        <head>
            <title>Document Control Tracking Report</title>
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; }
                .header { text-align: center; margin-bottom: 30px; }
                .summary { display: flex; justify-content: space-around; margin-bottom: 30px; }
                .summary-card { text-align: center; padding: 10px; border: 1px solid #ddd; }
                table { width: 100%; border-collapse: collapse; margin-top: 20px; }
                th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
                th { background-color: #f5f5f5; }
                .status-badge { padding: 2px 6px; border-radius: 3px; font-size: 12px; }
                @media print { .no-print { display: none; } }
            </style>
        </head>
        <body>
            <div class="header">
                <h2>Document Control Tracking Report</h2>
                <p>Tanggal: ${currentDate}</p>
            </div>
            <div class="summary">
                <div class="summary-card">
                    <h4>${$('#count-total').text()}</h4>
                    <p>Total</p>
                </div>
                <div class="summary-card">
                    <h4>${$('#count-pending').text()}</h4>
                    <p>Menunggu</p>
                </div>
                <div class="summary-card">
                    <h4>${$('#count-distributed').text()}</h4>
                    <p>Didistribusi</p>
                </div>
                <div class="summary-card">
                    <h4>${$('#count-received').text()}</h4>
                    <p>Diterima</p>
                </div>
                <div class="summary-card">
                    <h4>${$('#count-returned').text()}</h4>
                    <p>Dikembalikan</p>
                </div>
                <div class="summary-card">
                    <h4>${$('#count-overdue').text()}</h4>
                    <p>Terlambat</p>
                </div>
            </div>
        </body>
        </html>
    `;
    
    printWindow.document.write(printContent);
    printWindow.document.close();
    printWindow.print();
}
$(window).on('beforeunload', function() {
    $('.modal').modal('hide');
    $('.modal-backdrop').remove();
});
</script>
@endpush