@permission('manage-asset-tf-notification','manage-digital-assets','detail-ast-tf-notif')
<div class="btn-group">
  <a href="{{ $show_url }}" data-href="{{ $show_url }}" data-id="{{ $model->id }}" 
    id="show-detail-data" class="btn btn-sm btn-warning" data-toggle="tooltip" data-placement="top"  title="Detail Data">
    <i class="fas fa-eye"></i> <span></span>
  </a>
    <a href="#" 
        data-href="{{ $approval_url }}" 
        data-id="{{ $model->id }}" 
        row-approve1="{{ $model->approval_date1 }}"
        row-approve2="{{ $model->approval_date2 }}"
        row-approve3="{{ $model->approval_date3 }}"
        row-status1="{{ $model->approval_status1 }}"
        row-status2="{{ $model->approval_status2 }}"
        row-status3="{{ $model->approval_status3 }}"
        id="approval-data" 
        class="btn btn-sm btn-success" 
        data-toggle="tooltip" data-placement="top" 
    title="Approve">
     <i class="fas fa-check me-2"></i></span>
  </a>
    <a href="#" data-href="{{ $reject_url }}" 
      data-id="{{ $model->id }}" 
      id="reject-data" 
      class="btn btn-sm btn-danger" 
      row-approve1="{{ $model->approval_date1 }}"
      row-approve2="{{ $model->approval_date2 }}"
      row-approve3="{{ $model->approval_date3 }}"
      row-status1="{{ $model->approval_status1 }}"
      row-status2="{{ $model->approval_status2 }}"
      row-status3="{{ $model->approval_status3 }}"
      title="Detail Data">
     <i class="fas fa-times me-2"></i> </span>
  </a>
</div>

@endpermission