<div class="modal fade" tabindex="-1" id="edit-documents-master">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">EDIT DOCUMENTS MASTER</h5>
                    <button type="button" onclick="closeEditModal()" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editDocumentsForm" method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Hidden ID field for document identification -->
                        <input type="hidden" name="document_id" id="edit_document_id" value="">

                        <!-- Document Information -->
                        <fieldset class="border p-3 mb-4 rounded">
                            <legend class="w-auto px-2 text-primary font-weight-bold h6">Document Information</legend>

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Title</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="title" id="edit_title" placeholder="Enter document title" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Description</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend" style="height: auto;">
                                                <span class="input-group-text" style="height: 100%; display: flex; align-items: center; border-top-right-radius: 0; border-bottom-right-radius: 0;">
                                                    <i class="fa fa-file-text"></i>
                                                </span>
                                            </div>
                                            <textarea class="form-control" id="edit_description" name="description" rows="3" placeholder="Enter document description" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Type Docs -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Type Documents</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            </div>
                                            <select class="form-control" name="type_docs" id="edit_type_docs" required>
                                                <option value="">Select Document Type</option>
                                                <option value="workinstruction">Work Instruction</option>
                                                <option value="procedure">Procedure</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Current File Info -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Current File</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-file"></i></span>
                                            </div>
                                            {{-- file-storagefile-storage --}}
                                            <input type="hidden" id="file-storage-edit">
                                            <input type="text" class="form-control" id="current_file_name" placeholder="No file selected" readonly>
                                             {{-- <span class="text-muted ml-2" id="pdf-file-name"></span> --}}
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-info" id="view_current_file">
                                                    <i class="fa fa-eye"></i> View
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload (Optional for replacement) -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Replace Document <small class="text-muted">(Optional)</small></label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   class="custom-file-input"
                                                   id="edit_file_doc"
                                                   name="file_doc"
                                                   accept=".pdf,.xlsx,.xls,.doc,.docx">
                                            <label class="custom-file-label" for="edit_file_doc">Choose new file...</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Leave empty to keep current file. Supported formats: PDF, Excel (.xlsx/.xls), Word (.doc/.docx) - Max 10MB
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" onclick="closeEditModal()" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Cancel
                    </button>
                    <button type="button" class="btn btn-primary" id="updateDocsBtn">
                        <i class="fa fa-save"></i> Update
                    </button>
                </div>
            </div>
        </div>
    </div>
@push('js')
<script>
         document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.querySelector('#edit_file_doc');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        if (this.files && this.files[0]) {
                            var fileName = this.files[0].name;
                            var nextSibling = this.nextElementSibling;
                            nextSibling.innerText = fileName;
                        }
                    });
                }
            });

            function closeEditModal() {
                $('#edit-documents-master').modal('hide');
                $('#editDocumentsForm')[0].reset();
                $('#edit_file_doc').next('.custom-file-label').text('Choose new file...');
                $('#current_file_name').val('');
            }
             function closeDocumentModalEdit() {
                $('#pdf-viewer-modal').modal('hide');
                setTimeout(function() {
                    $('#edit-documents-master').modal('show');
                    $('#edit-documents-master').css('overflow-y', 'auto');
                }, 300);
            }
</script>
@endpush
