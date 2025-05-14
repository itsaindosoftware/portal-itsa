@permission('edit-department')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit Department">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-department')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-department" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Department">
  <i class="fas fa-trash"></i>
</a>
@endpermission
