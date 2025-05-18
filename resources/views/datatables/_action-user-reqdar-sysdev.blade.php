@if($model->approval_status1 == '1' && $model->approval_date1 != null)
    @permission(['manage-dar-system'])
    @if($model->approval_status2 == '2')
        <a href="javascript:void(0);" id="approved2-data-dar"
        data-id="{{ $model->reqdar_id }}"
        row-approve-manager="{{ $model->approval_date1 }}"
        row-approve-sysdev="{{ $model->approval_date2 }}"
         row-approved-status2={{ $model->approval_status2 }}
        class="btn btn-sm btn-outline-warning rounded-circle disabled" title="Data ditolak tidak bisa approved!" style="pointer-events: none; opacity: 0.65;">
        <i class="fas fa-check"></i>
    </a>
@else
    <a href="{{ $approve2 }}" id="approved2-data-dar"
    data-id="{{ $model->reqdar_id }}"
    row-approve-manager="{{ $model->approval_date1 }}"
    row-approve-sysdev="{{ $model->approval_date2 }}"
    row-approved-status2={{ $model->approval_status2 }}
    class="btn btn-sm btn-outline-warning rounded-circle" title="Approved">
    <i class="fas fa-check"></i>
    </a>
    @endif

@endpermission
{{-- @permission(['manager-dar-system']) --}}
    <a href="{{ $edit_url }}" id="edit-data-dar"
    data-id="{{ $model->reqdar_id }}"
    row-approve-manager="{{ $model->approval_date1 }}"
    row-approve-sysdev="{{ $model->approval_date2 }}"
    row-approve-manit="{{ $model->approval_date3 }}"
     row-approved-status2={{ $model->approval_status2 }}
    class="btn btn-sm btn-outline-warning rounded-circle" title="Edit">
    <i class="fas fa-edit"></i>
    </a>
 {{-- @endpermission --}}
@permission(['manage-dar-system'])
<a href="{{ $rejectedAppr2 }}" id="rejected2-data-dar"
data-id="{{ $model->reqdar_id }}"
row-approve-manager="{{ $model->approval_date1 }}"
row-approve-sysdev="{{ $model->approval_date2 }}"
class="btn btn-sm btn-outline-danger rounded-circle" title="Rejected">
  <i class="fas fa-ban"></i>
</a>
@endpermission

@permission(['manage-dar-system'])
<a href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-dar" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@endpermission
@else
<span class="badge badge-pill badge-danger">Data belum di approved oleh manager </span>
@endif
