@permission('edit-permission')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit Permission">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-permission')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-permission" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Permission">
  <i class="fas fa-trash"></i>
</a>
@endpermission
