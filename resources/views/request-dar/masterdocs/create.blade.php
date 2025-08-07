<div class="modal fade" id="add-documents-master">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">ADD DOCUMENTS MASTER</h5>
                    <button type="button" onclick="closeModal()" class="close text-white" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="documentsForm" method="POST" action="{{ route('masterdocs.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Document Information -->
                        <fieldset class="border p-3 mb-4 rounded">
                            <legend class="w-auto px-2 text-info font-weight-bold h6">Document Information</legend>

                            <div class="row">
                                <!-- Title -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Title</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-heading"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter document title" required>
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
                                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter document description" required style="resize: vertical; min-height: 100px; border-top-left-radius: 0; border-bottom-left-radius: 0;"></textarea>
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
                                            <select class="form-control" name="type_docs" id="type-docs" required>
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
                                        <label class="font-weight-bold">Distribution Dept</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-list"></i></span>
                                            </div>
                                            <select class="form-control" name="departments" id="departments" required>
                                                <option value="">--Select Departments--</option>
                                                {{-- <p>{{ $departments }}</p> --}}
                                                @foreach ($departments as $dept)
                                                    <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                                @endforeach
                                        
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Effective Date</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                            <input type="date" class="form-control" name="effective_date" id="effective-date" placeholder="Enter Effective Date" required>
                                        </div>
                                    </div>
                                </div>

                                <!-- File Upload -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Upload Document</label>
                                        <div class="custom-file">
                                            <input type="file"
                                                   class="custom-file-input"
                                                   id="file_doc"
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
                const fileInput = document.querySelector('.custom-file-input');
                if (fileInput) {
                    fileInput.addEventListener('change', function(e) {
                        var fileName = this.files[0].name;
                        var nextSibling = this.nextElementSibling;
                        nextSibling.innerText = fileName;
                    });
                }
            });
            function closeModal() {
                $('#add-documents-master').modal('hide');
                $('#documentsForm')[0].reset();
                $('.custom-file-label').text('Choose file...');
            }
        </script>
    @endpush
