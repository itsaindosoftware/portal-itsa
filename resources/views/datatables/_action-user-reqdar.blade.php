@permission(['manage-dar-system'])
<a href="{{ $edit_url }}" id="edit-data-dar" 
data-id="{{ $model->id }}" 
row-approve-manager="{{ $model->approval_date1 }}"
row-approve-sysdev="{{ $model->approval_date2 }}"
row-approve-manit="{{ $model->approval_date3 }}"
class="btn btn-sm btn-outline-warning rounded-circle" title="Edit">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission(['manage-dar-system'])
<a href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-dar" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@endpermission
