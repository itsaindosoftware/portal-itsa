@permission('edit-company')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-pill" title="Edit Company">
  <i class="fas fa-edit"></i>
</a>
@endpermission

@permission('delete-company')
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-company" class="btn btn-sm btn-outline-danger rounded-pill" title="Delete Company">
  <i class="fas fa-trash"></i>
</a>
@endpermission
