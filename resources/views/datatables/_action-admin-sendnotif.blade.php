@permission('manage-asset-tf-notification','manage-digital-assets','detail-ast-tf-notif')
<div class="btn-group">
  <a href="{{ $show_url }}" data-href="{{ $show_url }}" data-id="{{ $model->id }}" 
    id="show-detail-data" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"  title="Detail Data">
    <i class="fas fa-eye"></i> <span></span>
  </a>
   <a href="#" data-href="{{ $edit_url }}" data-id="{{ $model->id }}" 
    id="edit-detail-data" class="btn btn-sm btn-info" data-toggle="tooltip" data-placement="top"  title="Edit Data">
    <i class="fas fa-edit"></i> <span></span>
  </a>
   <a href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" 
    id="delete-detail-data" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top"  title="Delete Data">
    <i class="fas fa-trash"></i> <span></span>
  </a>


</div>

@endpermission