@permission(['manage-dar-system'])
@if($model->approval_status1 == '2')
<a href="javascript:void(0);" id="approved1-data-dar"
data-id="{{ $model->reqdar_id }}"
row-approve-manager="{{ $model->approval_date1 }}"
class="btn btn-sm btn-outline-warning rounded-circle disabled" title="Data ditolak tidak bisa approved!" style="pointer-events: none; opacity: 0.65;">
  <i class="fas fa-check"></i>
</a>
@else
<a href="{{ $approve1 }}" id="approved1-data-dar"
data-id="{{ $model->reqdar_id }}"
row-approve-manager="{{ $model->approval_date1 }}"
class="btn btn-sm btn-outline-warning rounded-circle" title="Approved">
  <i class="fas fa-check"></i>
</a>
@endif

@endpermission
@permission(['manage-dar-system'])
<a href="{{ $rejectedAppr1 }}" id="rejected1-data-dar"
data-id="{{ $model->reqdar_id }}"
row-approve-manager="{{ $model->approval_date1 }}"
class="btn btn-sm btn-outline-danger rounded-circle" title="Rejected">
  <i class="fas fa-ban"></i>
</a>
@endpermission

@permission(['manage-dar-system'])
<a href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-dar" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@endpermission
