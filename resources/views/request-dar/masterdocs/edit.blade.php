<div class="modal fade" tabindex="-1" id="edit-documents-master">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">EDIT NEW DOCUMENTS/FROM REQUEST</h5>
                    <button type="button" onclick="closeEditModal()" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info mb-4">
                        <h6 class="alert-heading"><i class="fa fa-info-circle"></i> Guidance / Petunjuk Penggunaan:</h6>
                        <ul class="mb-0 small">
                            <li><strong>Tekan Enter</strong> pada field Title untuk memunculkan data dari request perubahan</li>
                            <li><strong>Masukan data langsung</strong> tanpa menekan keyboard Enter untuk input manual</li>
                            <li><strong>Jika data document baru</strong>, pilih is_archived nya <strong>"New"</strong></li>
                            <li><strong>Jika menggunakan document dari request</strong>, pilih is_archived nya <strong>"Archived"</strong></li>
                        </ul>
                    </div>
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
                                         <small class="form-text text-muted">
                                            <i class="fa fa-lightbulb-o"></i> Tekan <kbd>Enter</kbd> untuk mencari data dari request atau ketik langsung untuk input manual
                                        </small>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Archive Status</label>
                                        <div class="border rounded p-3" style="background-color: #f8f9fa;">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="is_archived" id="is_archived_edit" value="new">
                                                <label class="form-check-label" for="is_archived_new">
                                                    <i class="fa fa-file-o text-success"></i> <strong>New Document</strong>
                                                </label>
                                            </div>
                                            <div class="form-check form-check-inline ml-4">
                                                <input class="form-check-input" type="radio" name="is_archived" id="is_archived_edit" value="archived">
                                                <label class="form-check-label" for="is_archived_archived">
                                                    <i class="fa fa-archive text-warning"></i> <strong>From Request (Archived)</strong>
                                                </label>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Pilih "New Document" untuk dokumen baru atau "From Request" jika menggunakan data dari request perubahan
                                        </small>
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
                                                <option value="">--Select Document Type--</option>
                                                @foreach ($typeDoc as $type)
                                                    <option value="{{ $type->id }}">{{ $type->request_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                  <!-- Distribution Departments -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Distribution Departments</label>
                                        <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto; background-color: #f8f9fa;">
                                            <!-- Select All Option -->
                                            <div class="form-check mb-2 border-bottom pb-2">
                                                <input type="checkbox" class="form-check-input" id="select_all_dept_edit" onchange="toggleAllDepartmentsEdit(this)">
                                                <label class="form-check-label font-weight-bold text-primary" for="select_all_dept_edit">
                                                    <i class="fa fa-check-square"></i> Select All Departments
                                                </label>
                                            </div>
                                            
                                            <!-- Department Checkboxes -->
                                            <div class="row">
                                                @foreach ($departments as $dept)
                                                <div class="col-md-6">
                                                    <div class="form-check mb-2">
                                                        <input type="checkbox" 
                                                               class="form-check-input dept-checkbox-edit" 
                                                               id="dept_{{ $dept->id }}_edit" 
                                                               name="departments[]" 
                                                               value="{{ $dept->id }}"
                                                               onchange="updateSelectedDeptCountUpdt()">
                                                        <label class="form-check-label" for="dept_{{ $dept->id }}_edit">
                                                            <i class="fa fa-building-o mr-1"></i>{{ $dept->description }}
                                                        </label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            
                                            <!-- Selected Count Display -->
                                            <div class="mt-2 pt-2 border-top">
                                                <small class="text-muted">
                                                    <i class="fa fa-info-circle"></i> 
                                                    Selected: <span id="selected-dept-count-edit">0</span> department(s)
                                                </small>
                                            </div>
                                        </div>
                                        <small class="form-text text-muted">
                                            Select one or more departments where this document will be distributed
                                        </small>
                                    </div>
                                </div>

                                {{-- <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Distribution Dept</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            </div>
                                            <select class="form-control" name="departments" id="departments-edit" required>
                                                <option value="">--Select Departments--</option>
                                                {{-- <p>{{ $departments }}</p> --}}
                                                {{-- @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                                @endforeach
                                        
                                            </select>
                                        </div>
                                    </div>
                                </div> --}} 
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Effective Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="effective_date" id="effective-date-edit" placeholder="Enter Effective Date" required>
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
                                        <div class="custom-file-edit">
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
                        <input type="hidden" name="existing_file_path" id="existing-file-path-edit">
                        <input type="hidden" name="existing_file_name" id="existing-file-name-edit">
                        <input type="hidden" name="reqdar_id" id="reqdar-id-edit">
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
                $('.dept-checkbox-edit').prop('checked', false);
                $('#select_all_dept_edit').prop('checked', false);
                $('#select_all_dept_edit').prop('indeterminate', false);
                const checkedCount = $('.dept-checkbox-edit:checked').length;
                 $('#selected-dept-count-edit').text(checkedCount);
                
                // Reset radio buttons
                $('input[name="is_archived"]').prop('checked', false);
            }
             function closeDocumentModalEdit() {
                $('#pdf-viewer-modal').modal('hide');
                setTimeout(function() {
                    $('#edit-documents-master').modal('show');
                    $('#edit-documents-master').css('overflow-y', 'auto');
                }, 300);
            }
        function updateSelectedDeptCountUpdt() {
            const checkedCount = $('.dept-checkbox-edit:checked').length;
            $('#selected-dept-count-edit').text(checkedCount);
           }
</script>
@endpush
