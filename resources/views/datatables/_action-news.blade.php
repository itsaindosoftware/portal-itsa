@permission('manage-portalitsa-news')
<a href="{{ $edit_url }}" class="btn btn-sm btn-outline-warning rounded-circle" title="Edit">
  <i class="fas fa-edit"></i>
</a>
<a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="deleted-data-news" class="btn btn-sm btn-outline-danger rounded-circle" title="Delete">
  <i class="fas fa-trash"></i>
</a>
<a href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-news" class="btn btn-sm btn-outline-secondary rounded-circle" title="Show">
  <i class="fas fa-eye"></i>
</a>
@else
<span class="text-muted">No access</span>
@endpermission