<div class="modal fade document-modal" tabindex="-1" id="view-document-modal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <!-- Custom Header -->
                <div class="document-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="modal-title mb-2">
                                <i class="fas fa-file-alt me-2"></i>
                                <span id="view_document_title">Document Details</span>
                            </h5>
                            <p class="mb-0 opacity-75" id="document_subtitle">Complete document information</p>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                </div>

                <input type="hidden" id="id-view-docs">

                <!-- Document Information -->
                <div class="document-info">
                    <table class="table document-table">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-heading info-icon"></i> Document Title</th>
                                <td>
                                    <strong id="view_document_title_content">-</strong>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-tags info-icon"></i> Document Type</th>
                                <td>
                                    <span class="type-badge" id="view_type_badge">-</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-align-left info-icon"></i> Description</th>
                                <td>
                                    <div id="view_description" class="text-muted">-</div>
                                </td>
                            </tr>
                            @role('sysdev')
                            <tr>
                                <th><i class="fas fa-building info-icon"></i> Departments</th>
                                <td>
                                    <div class="dept-list" id="departments-view">
                                        <span class="no-data">No departments assigned</span>
                                    </div>
                                </td>
                            </tr>
                            @endrole
                            <tr>
                                <th><i class="fas fa-calendar-plus info-icon"></i> Effective Date</th>
                                <td>
                                    <span class="date-text" id="effective-date-view">-</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-calendar-edit info-icon"></i> Last Updated</th>
                                <td>
                                    <span class="date-text" id="revision-date-view">-</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-info-circle info-icon"></i> Status</th>
                                <td>
                                    <span class="status-badge text-white" id="document-status">-</span>
                                </td>
                            </tr>
                            
                            <tr>
                                <th><i class="fas fa-paperclip info-icon"></i> Attached File</th>
                                <td>
                                    <input type="hidden" id="file-storage-view">
                                    <div class="file-info">
                                        <div class="flex-grow-1">
                                            <div class="d-flex align-items-center mb-2">
                                                <i class="fas fa-file-pdf me-2 text-danger" id="view_file_icon"></i>
                                                <span id="view_file_name">No file attached</span>
                                            </div>
                                            <div class="file-actions">
                                                <button type="button" class="btn btn-primary btn-sm" id="view_file_btn" style="display: none;">
                                                    <i class="fas fa-eye me-1"></i> Preview
                                                </button>
                                                <a href="#" class="btn btn-success btn-sm" download target="_blank" id="download_file_btn_view" style="display: none;">
                                                    <i class="fas fa-download me-1"></i> Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeViewModal()" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Close
                </button>
                {{-- <button type="button" class="btn btn-primary" id="edit-document-btn">
                    <i class="fas fa-edit me-1"></i>Edit Document
                </button> --}}
            </div>
        </div>
    </div>
</div>

@push('js')
     <script>
        // Function to close the view modal
        function closeViewModal() {
            $('#view-document-modal').modal('hide');
        }
         function closeDocumentModal() {
            $('#pdf-viewer-modal-view').modal('hide');
            setTimeout(function() {
                $('#view-document-modal').modal('show');
                $('#view-document-modal').css('overflow-y', 'auto');
            }, 300);
        }
        // Function to populate modal with document data

        // Helper function to format date
        function formatDate(dateString) {
            if (!dateString) return 'N/A';

            const date = new Date(dateString);
            return date.toLocaleDateString('en-US', {
                year: 'numeric',
                month: 'short',
                day: 'numeric'
            });
        }

        // Example usage - you would call this function with your document data
        // showDocumentDetails();
    </script>
@endpush
