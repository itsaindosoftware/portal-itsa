@permission(['manage-dar-system'])
<div class="dropdown">
  <button class="btn btn-sm btn-outline-primary dropdown-toggle rounded-circle"
          type="button"
          id="dropdownMenuButton{{ $model->reqdar_id }}"
          data-toggle="dropdown"
          aria-haspopup="true"
          aria-expanded="false"
          title="Actions">
    <i class="fas fa-cogs"></i>
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $model->reqdar_id }}">
    {{-- <a class="dropdown-item text-warning" href="{{ $edit_url }}" data-id="{{ $model->reqdar_id }}">
      <i class="fas fa-edit mr-2"></i> Edit
    </a> --}}
    <a class="dropdown-item text-danger" href="#" data-href="{{ $delete_url }}" data-id="{{ $model->reqdar_id }}" id="delete-data-dar">
      <i class="fas fa-trash mr-2"></i> Delete
    </a>
    {{-- <a class="dropdown-item text-secondary" href="#" data-href="{{ $show_url }}" data-id="{{ $model->reqdar_id }}">
      <i class="fas fa-eye mr-2"></i> Show
    </a> --}}
      <a class="dropdown-item" href="#" data-href="{{ $show_url }}" data-id="{{ $model->reqdar_id }}" id="show-data-dar">
        <i class="fas fa-eye text-secondary"></i> Show
    </a>
  </div>
</div>
@endpermission
