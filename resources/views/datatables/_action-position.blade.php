@permission('edit-position')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit Position">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-position')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-position" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Position">
  <i class="fas fa-trash"></i>
</a>
@endpermission
