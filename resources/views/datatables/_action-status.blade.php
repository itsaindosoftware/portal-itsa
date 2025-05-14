<div class="text-center">
    @if ($model->status !== '1')
        <span class="badge badge-pill badge-danger"> Close</span>
    @else
        <span class="badge badge-pill badge-success"></i> Open</span>
    @endif
</div>
