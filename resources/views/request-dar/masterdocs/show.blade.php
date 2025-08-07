 <div class="modal fade" tabindex="-1" id="view-document-modal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-file-alt me-2"></i>
                        <span id="view_document_title">Document Details</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <input type="hidden" id="id-view-docs">

                <div class="modal-body">
                    <table class="table table-striped document-table">
                        <tbody>
                            <tr>
                                <th><i class="fas fa-heading me-2"></i> Title</th>
                                <td id="view_document_">-</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-tags me-2"></i> Document Type</th>
                                <td><span class="type-badge" id="view_type_badge">-</span></td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-file me-2"></i> Description</th>
                                <td id="view_description">-</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-list me-2"></i> Department</th>
                                <td id="departments-view">-</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar me-2"></i> Effective Date</th>
                                <td id="effective-date-view">-</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-calendar me-2"></i> Revision Date</th>
                                <td id="revision-date-view">-</td>
                            </tr>
                            <tr>
                                <th><i class="fas fa-paperclip me-2"></i> Attached File</th>
                                <td>
                                    <input type="hidden" id="file-storage-view">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-file-pdf me-2 text-danger" id="view_file_icon"></i>
                                        <span id="view_file_name">No file attached</span>
                                    </div>
                                    <div class="file-actions mt-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm" id="view_file_btn">
                                            <i class="fas fa-eye me-1"></i> View File
                                        </button>
                                        <a href="#" class="btn btn-outline-success btn-sm" download target="_blank" id="download_file_btn_view">
                                            <i class="fas fa-download me-1"></i> Download
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="closeViewModal()" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
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
