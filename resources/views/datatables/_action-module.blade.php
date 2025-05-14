@permission('edit-module')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit Module">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-module')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-module" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Module">
  <i class="fas fa-trash"></i>
</a>
@endpermission
