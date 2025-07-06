<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                <button type="button" onclick="closeModal()" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="" class="img-fluid rounded">
            </div>
            <div class="modal-footer">
                <a id="modalDownloadBtn" href="" download="" class="btn btn-primary">
                    <i class="fas fa-download me-2"></i>
                    Download
                </a>
                 <button type="button" 
                        class="btn btn-secondary" 
                        data-bs-dismiss="modal"
                        onclick="closeModal()">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
