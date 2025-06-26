<div class="modal fade" tabindex="-1" id="create-digassets">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title create">ASSET TRANSFER NOTIFICATION</h5>
                <button type="button" onclick="closeModal()" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info">
                    <small><strong>Note:</strong> This form is to be used when assets are transferred from one Responsibility Centre to another.</small>
                </div>
                
                <form id="form-send-notif" method="POST" action="{{ route('transfernotif.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <!-- Section 1: Transfer of Asset FROM -->
                    <input type="hidden" name="id_fixed_asset" id="id-fix-reg-assets">
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">
                            Section 1: Transfer of Asset FROM 
                            <small class="text-muted">(to be completed by transferring Department/Unit)</small>
                        </legend>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="transferring_dept" class="form-label">Name of <u>transferring</u> Dept:</label>
                                <select class="form-control" id="transferring-dept" name="transferring_dept" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="cost_center_from" class="form-label">Cost Center:</label>
                                <select class="form-control" id="cost-center-from" name="cost_center_from" required>
                                    <option value="">Select Cost Center</option>
                                    @foreach($masterAssetCostCenters as $cc)
                                        <option value="{{ $cc->id }}">{{ $cc->cost_center_code }} - {{ $cc->cost_center_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="item_description" class="form-label">Item description (Asset Name):</label>
                                <textarea class="form-control" id="item-description" name="item_description" rows="3" 
                                    placeholder="Enter detailed description of the asset" required></textarea>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="io_no_from" class="form-label">IO No.:</label>
                                <input type="text" class="form-control" id="io-no-from" name="io_no_from" 
                                    placeholder="Enter IO Number" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="asset_tag_number" class="form-label">Asset Tag Number:</label>
                                <input type="text" class="form-control" id="asset-tag-number" name="asset_tag_number" 
                                    placeholder="Enter Asset Tag Number" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="location_from" class="form-label">Location:</label>
                                <select class="form-control" id="location-from" name="location_from" required>
                                    <option value="">Select Location</option>
                                    @foreach($masterAssetLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->asset_location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="quantity_from" class="form-label">Quantity:</label>
                                <input type="number" class="form-control" id="quantity-from" name="quantity_from" 
                                    min="1" value="1" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="pic_name_from" class="form-label">PIC Name:</label>
                                <input type="text" class="form-control" id="pic-name-from" name="pic_name_from" 
                                    placeholder="Person in Charge" required>
                            </div>
                        </div>

                        <!-- Approval by Financial Delegations -->
                        <div class="bg-light p-3 rounded">
                            <h6 class="text-secondary mb-3"><em>Approval by Financial Delegations:</em></h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="date_of_transfer" class="form-label">Date of Transfer:</label>
                                    <input type="date" class="form-control" id="date-of-transfer" name="date_of_transfer" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="io_no_approval" class="form-label">IO No.:</label>
                                    <input type="text" class="form-control" id="io-no-approval" name="io_no_approval" 
                                        placeholder="IO Number for approval">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Section 2: Transfer of Asset TO -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">
                            Section 2: Transfer of Asset TO 
                            <small class="text-muted">(to be completed by receiving Department/Unit)</small>
                        </legend>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="receiving_dept" class="form-label">Name of <u>receiving</u> department:</label>
                                <select class="form-control" id="receiving-dept" name="receiving_dept" required>
                                    <option value="">Select Department</option>
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->description }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="new_cost_center" class="form-label">New Cost Center:</label>
                                <select class="form-control" id="new-cost-center" name="new_cost_center" required>
                                    <option value="">Select New Cost Center</option>
                                    @foreach($masterAssetCostCenters as $cc)
                                        <option value="{{ $cc->id }}">{{ $cc->cost_center_code }} - {{ $cc->cost_center_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_location" class="form-label">New Location:</label>
                                <select class="form-control" id="new-location" name="new_location" required>
                                    <option value="">Select New Location</option>
                                    @foreach($masterAssetLocations as $location)
                                        <option value="{{ $location->id }}">{{ $location->asset_location_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="quantity_to" class="form-label">Quantity:</label>
                                <input type="number" class="form-control" id="quantity-to" name="quantity_to" 
                                    min="1" value="1" required>
                            </div>
                            
                            <div class="col-md-3 mb-3">
                                <label for="pic_name_to" class="form-label">PIC Name:</label>
                                <input type="text" class="form-control" id="pic-name-to" name="pic_name_to" 
                                    placeholder="Person in Charge" required>
                            </div>
                        </div>

                        <!-- Approval by Financial Delegations - Section 2 -->
                        <div class="bg-light p-3 rounded">
                            <h6 class="text-secondary mb-3"><em>Approval by Financial Delegations:</em></h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="effective_date" class="form-label">Effective Date:</label>
                                    <input type="date" class="form-control" id="effective-date" name="effective_date" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="transfer_ref_no" class="form-label">Transfer Ref no. ERP:</label>
                                    <input type="text" class="form-control" id="transfer-ref-no" name="transfer_ref_no" 
                                        placeholder="ERP Reference Number">
                                </div>
                            </div>
                        </div>
                    </fieldset>

                    <!-- Additional Information -->
                    <fieldset class="border p-3 mb-4 rounded">
                        <legend class="w-auto px-2 text-info font-weight-bold h6">Additional Information</legend>
                        
                        {{-- <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="remarks" class="form-label">Remarks/Notes:</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3" 
                                    placeholder="Any additional notes or remarks about the transfer"></textarea>
                            </div>
                        </div> --}}

                        {{-- <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="company_id" class="form-label">Company:</label>
                                <select class="form-control" id="company_id" name="company_id" required>
                                    <option value="">Select Company</option> --}} 
                                    {{-- @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_desc }}</option>
                                    @endforeach --}}
                                {{-- </select>
                            </div> --}}
{{--                             
                            <div class="col-md-6 mb-3">
                                <label for="asset_group" class="form-label">Asset Group:</label>
                                <select class="form-control" id="asset_group" name="asset_group" required>
                                    <option value="">Select Asset Group</option> --}}
                                    {{-- @foreach($masterAssetGroups as $group)
                                        <option value="{{ $group->id }}">{{ $group->asset_group_name }}</option>
                                    @endforeach --}}
                                {{-- </select>
                            </div>
                        </div> --}}

                        <!-- File Upload -->
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="supporting_documents" class="form-label">Supporting Documents (if any):</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="supporting-documents" 
                                        name="supporting_documents" 
                                        accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                    <label class="custom-file-label" for="supporting_documents">Choose files...</label>
                                </div>
                                <small class="form-text text-muted">
                                    Accepted formats: PDF, DOC, DOCX, JPG, JPEG, PNG
                                </small>
                            </div>
                        </div> 
                    </fieldset>
                   </form>
            </div>
            
            <div class="modal-footer bg-light">
                <button type="button" onclick="closeModal()" class="btn btn-secondary">
                    <i class="ti-close"></i> Close
                </button>
                <button type="button" class="btn btn-info submitTransfer" id="submit-transfer">
                    <i class="ti-check"></i> Submit Transfer Request
                </button>
            </div>
              
        </div>
    </div>
</div>

<!-- Script for file input and form validation -->
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input handler
        const fileInput = document.querySelector('.custom-file-input');
        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                let fileNames = [];
                for (let i = 0; i < this.files.length; i++) {
                    fileNames.push(this.files[i].name);
                }
                var nextSibling = this.nextElementSibling;
                nextSibling.innerText = fileNames.length > 0 ? fileNames.join(', ') : 'Choose files...';
            });
        }

        // Sync quantity fields
        document.getElementById('quantity-from').addEventListener('input', function() {
            document.getElementById('quantity-to').value = this.value;
        });

        // Form validation
        document.getElementById('form-send-notif').addEventListener('button', function(e) {
            // e.preventDefault();
            
            // Basic validation
            const requiredFields = this.querySelectorAll('[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            // Check if quantities match
            const qtyFrom = document.getElementById('quantity-from').value;
            const qtyTo = document.getElementById('quantity-to').value;
            
            if (qtyFrom !== qtyTo) {
                alert('Quantity in both sections must match!');
                return;
            }

            if (isValid) {
                // Show loading state
                const submitBtn = document.querySelector('.submitTransfer');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fa fa-spinner fa-spin"></i> Processing...';
                submitBtn.disabled = true;

                // Submit form
                this.submit();
            } else {
                alert('Please fill in all required fields!');
            }
        });
    });

    function closeModal() {
        $('#create-digassets').modal('hide');
        $('#form-send-notif')[0].reset();
        
        // Remove validation classes
        document.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        
        // Reset file input label
        const fileLabel = document.querySelector('.custom-file-label');
        if (fileLabel) {
            fileLabel.innerText = 'Choose files...';
        }
    }

    // Auto-fill effective date when transfer date is selected
    // document.getElementById('date_of_transfer').addEventListener('change', function() {
    //     const effectiveDate = document.getElementById('effective_date');
    //     if (!effectiveDate.value) {
    //         effectiveDate.value = this.value;
    //     }
    // });
</script>
@endpush
