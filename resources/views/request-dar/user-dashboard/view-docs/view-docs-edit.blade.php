<div class="modal fade" id="pdf-viewer-modal" tabindex="-1" role="dialog" aria-labelledby="pdfViewerModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" style="max-width: 90%;">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="pdfViewerModalLabel">Lihat Dokumen</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" onclick="closeDocumentModal()">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0" style="height: 80vh;">
                <iframe id="pdf-viewer-iframe" style="width: 100%; height: 100%; border: none;"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeDocumentModal()" data-dismiss="modal">Tutup</button>
                <a id="download-pdf-btn" href="#" class="btn btn-primary" download target="_blank">
                    <i class="fa fa-download"></i> Download
                </a>
            </div>
        </div>
    </div>
</div>