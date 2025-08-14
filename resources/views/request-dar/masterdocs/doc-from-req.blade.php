<div class="modal fade" id="add-documents-from-req">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">ADD DOCUMENTS FROM REQUEST</h5>
                    <button type="button" onclick="closeModal()" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="documentsForm" method="POST" action="{{ route('masterdocs.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Document Information -->
                        <fieldset class="border p-3 mb-4 rounded">
                            <legend class="w-auto px-2 font-weight-bold h6">Document Information</legend>

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Title</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="title" id="title-from-req" placeholder="Tekan Enter Untuk Mencari Document" required>
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
                                            <textarea class="form-control" id="description-req" name="description" rows="3" placeholder="Enter document description" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
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
                                            <select class="form-control" name="type_docs" id="type-docs-req" required>
                                                <option value="">--Select Document Type--</option>
                                                @foreach ($typeDoc as $type)
                                                    <option value="{{ $type->id }}">{{ $type->request_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Distribution Departments</label>
                                    <div class="border rounded p-3" style="max-height: 250px; overflow-y: auto; background-color: #f8f9fa;">
                                        <!-- Select All Option -->
                                        <div class="form-check mb-2 border-bottom pb-2">
                                            <input type="checkbox" class="form-check-input" id="select_all_dept" onchange="toggleAllDepartments(this)">
                                            <label class="form-check-label font-weight-bold text-primary" for="select_all_dept">
                                                <i class="fa fa-check-square"></i> Select All Departments
                                            </label>
                                        </div>
                                        
                                        <!-- Department Checkboxes -->
                                        <div class="row">
                                            @foreach ($departments as $dept)
                                            <div class="col-md-6">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" 
                                                           class="form-check-input dept-checkbox" 
                                                           id="dept_{{ $dept->id }}" 
                                                           name="departments[]" 
                                                           value="{{ $dept->id }}"
                                                           onchange="updateSelectAllState()">
                                                    <label class="form-check-label" for="dept_{{ $dept->id }}">
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
                                                Selected: <span id="selected-dept-count">0</span> department(s)
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
                                            <select class="form-control" name="departments" id="departments" required>
                                                <option value="">--Select Departments--</option>
                                                {{-- <p>{{ $departments }}</p> --}}
                                                {{-- @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                                @endforeach --}}
                                        
                                            {{-- </select> --}}
                                        {{-- </div>
                                    </div> --}}
                                {{-- </div>  --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Effective Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="effective_date" id="effective-date-req" placeholder="Enter Effective Date" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Upload Document</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   class="custom-file-input-req"
                                                   id="file_doc_req"
                                                   name="file_doc"
                                                   accept=".pdf,.xlsx,.xls,.doc,.docx"
                                                   required>
                                            <label class="custom-file-label" for="file_doc">Choose file...</label>
                                        </div>
                                        <small class="form-text text-muted">
                                            Supported formats: PDF, Excel (.xlsx/.xls), Word (.doc/.docx) - Max 10MB
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                         <input type="hidden" name="status-doc" value="archived" id="status-doc">
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" onclick="closeModal()" class="btn btn-secondary">
                        <i class="fa fa-times"></i> Close
                    </button>
                    <button type="button" class="btn btn-info submitdocs">
                        <i class="fa fa-check"></i> Submit
                    </button>
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const fileInput = document.querySelector('.custom-file-input-req');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        var fileName = this.files[0].name;
                        var nextSibling = this.nextElementSibling;
                        console.log(fileName)
                        nextSibling.innerText = fileName;
                    });
                }
                updateSelectedDeptCount();
            });
            function closeModal() {
                $('#add-documents-from-req').modal('hide');
                $('#documentsForm')[0].reset();
                $('.custom-file-label-req').text('Choose file...');
                // 
                $('.dept-checkbox').prop('checked', false);
                $('#select_all_dept').prop('checked', false).prop('indeterminate', false);
                updateSelectedDeptCount();
            }
            function toggleAllDepartments(selectAllCheckbox) {
                const isChecked = selectAllCheckbox.checked;
                $('.dept-checkbox').prop('checked', isChecked);
                updateSelectedDeptCount();
            }
            function updateSelectAllState() {
                const totalCheckboxes = $('.dept-checkbox').length;
                const checkedCheckboxes = $('.dept-checkbox:checked').length;
                const selectAllCheckbox = $('#select_all_dept')[0];
                
                if (checkedCheckboxes === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else if (checkedCheckboxes === totalCheckboxes) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                }
                
                updateSelectedDeptCount();
            }
            function updateSelectedDeptCount() {
                const checkedCount = $('.dept-checkbox:checked').length;
                $('#selected-dept-count').text(checkedCount);
            }
            function validateDepartmentSelection() {
                const checkedCount = $('.dept-checkbox:checked').length;
                if (checkedCount === 0) {
                    alert('Please select at least one department for distribution.');
                    return false;
                }
                return true;
            }
            function getSelectedDepartments() {
                var selectedDepts = [];
                $('.dept-checkbox:checked').each(function() {
                    selectedDepts.push($(this).val());
                });
                return selectedDepts;
            }
            function addDepartmentsToFormData(formData) {
                var selectedDepts = getSelectedDepartments();
                
                // Clear any existing departments entries
                if (formData.has('departments[]')) {
                    formData.delete('departments[]');
                }
                
                // Add each selected department to FormData
                selectedDepts.forEach(function(deptId, index) {
                    formData.append('departments[' + index + ']', deptId);
                    // Alternative way: formData.append('departments[]', deptId);
                });
                
                return selectedDepts.length;
            }
        </script>
    @endpush
