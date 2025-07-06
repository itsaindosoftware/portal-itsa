@permission('manage-asset-tf-notification','manage-digital-assets','detail-ast-tf-notif')
 @if($model->transfer_status == 'pending')
  <a href="#" data-href="{{ $sendNotif }}" data-id="{{ $model->id ?? $model->id_fixed_assets }}" id="sendnotif-data" class="btn btn-sm btn-warning" title="Transfer asset">
    <i class="fas fa-paper-plane"></i> <span>Send Transfer</span>
    </a>
@elseif ($model->transfer_status == 'sent')    
  <a href="{{ $show_url }}" data-href="{{ $show_url }}" data-id="{{ $model->id ?? $model->id_fixed_assets }}" id="show-detail-data" class="btn btn-sm btn-success" title="Detail Data">
    <i class="fas fa-eye"></i> <span> Detail</span>
  </a>

@endif

                

@endpermission