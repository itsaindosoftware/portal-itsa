<div class="text-center">
    @if ($model->approval_status2 == '0')
        <span class="badge badge-pill badge-warning"> Waiting Approval</span>
    @elseif($model->approval_status2 == '1')
        <span class="badge badge-pill badge-success"></i> Approved</span>
    @else
         <span class="badge badge-pill badge-danger"></i> Rejected</span>
    @endif
</div>
