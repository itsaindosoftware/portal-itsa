@permission(['manage-digital-assets'])
@if ($model->approval_status2 != '0')
  <a href="#" id="edit-data-notif" class="btn btn-sm btn-outline-warning rounded-circle" title="Edit">
    <i class="fas fa-edit"></i>
  </a>
@else
  <a href="{{ $edit_url }}" id="edit-data"
  data-id="{{ $model->id }}"
  row-approve1="{{ $model->approval_date1 }}"
  row-approve2="{{ $model->approval_date2 }}"
  row-approve3="{{ $model->approval_date3 }}"
  class="btn btn-sm btn-outline-warning rounded-circle" title="Edit">
    <i class="fas fa-edit"></i>
  </a>
@endif

@endpermission

@permission(['manage-digital-assets'])
<a href="{{ $show_url }}" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@endpermission

{{-- @permission(['manage-digital-assets'])
<a href="{{ $approve_url1 }}" data-href="{{ $approve_url1 }}" 
data-id="{{ $model->id }}" 
id="approved-1" 
row-approve1="{{ $model->approval_date1 }}"
row-approve2="{{ $model->approval_date2 }}"
row-approve3="{{ $model->approval_date3 }}"
class="btn btn-sm btn-outline-success rounded-circle" title="Approved1">
  <i class="fas fa-check"></i>
</a>
@endpermission --}}
