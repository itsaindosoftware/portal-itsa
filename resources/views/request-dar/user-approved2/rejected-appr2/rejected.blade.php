<div class="modal fade" tabindex="-1" id="reject2-modal">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Konfirmasi Rejected</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="rejectForm2" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="reject2-id">
                    <div class="form-group">
                        <label for="reject_reason" class="font-weight-bold">Alasan Rejected</label>
                        <div class="input-group">
                            <div class="input-group-prepend" style="height: auto;">
                                <span class="input-group-text" style="height: 100%; display: flex; align-items: center;">
                                    <i class="fa fa-comment"></i>
                                </span>
                            </div>
                            <textarea class="form-control" id="reject_reason2" name="reject_reason2" rows="3"
                                placeholder="Masukkan alasan penolakan dokumen" required
                                style="resize: vertical; min-height: 80px;"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" onclick="closeRejectModal()" class="btn btn-secondary">
                    <i class="ti-close"></i> Batal
                </button>
                <button type="button" class="btn btn-danger submit-reject2">
                    <i class="ti-close"></i> Reject
                </button>
            </div>
        </div>
    </div>
</div>
@push('js')
<script>
    function closeRejectModal() {
        $('#reject2-modal').modal('hide');
        $('#rejectForm2')[0].reset();
    }

</script>

@endpush
