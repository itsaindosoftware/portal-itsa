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
