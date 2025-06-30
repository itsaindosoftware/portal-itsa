
@permission(['manage-digital-assets'])
<a href="{{ $show_url }}" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@endpermission

@permission(['manage-digital-assets'])
<a href="#" data-href="{{ $approve_url3 }}" 
data-id="{{ $model->id }}" 
id="approved-3" 
row-approve1="{{ $model->approval_date1 }}"
row-approve2="{{ $model->approval_date2 }}"
row-approve3="{{ $model->approval_date3 }}"
class="btn btn-sm btn-outline-success rounded-circle" title="Approved1">
  <i class="fas fa-check"></i>
</a>
<a href="#" data-href="{{ $rejected_url3 }}" 
data-id="{{ $model->id }}" 
id="rejected-3" 
row-approve1="{{ $model->approval_date1 }}"
row-approve2="{{ $model->approval_date2 }}"
row-approve3="{{ $model->approval_date3 }}"
class="btn btn-sm btn-outline-danger rounded-circle" title="Rejected2">
  <i class="fas fa-times"></i>
</a>
@endpermission
