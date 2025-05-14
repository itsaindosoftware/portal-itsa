@permission('edit-role')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit & Set Permission">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-role')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-role" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Role">
  <i class="fas fa-trash"></i>
</a>
@endpermission
