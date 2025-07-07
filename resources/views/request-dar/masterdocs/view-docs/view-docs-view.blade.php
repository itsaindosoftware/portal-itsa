<div class="modal fade" id="pdf-viewer-modal-view" tabindex="-1" role="dialog" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="pdfViewerModalLabel">Display Document</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" onclick="closeDocumentModalview()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="height: 80vh;">
                <iframe id="pdf-viewer-iframe-view" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDocumentModalview()" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
