@permission(['manage-dar-system'])
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $model->reqdar_id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $model->reqdar_id }}">
            @if($model->approval_status1 == '2')
                <a class="dropdown-item disabled" href="javascript:void(0);" title="Data ditolak tidak bisa approved!">
                    <i class="fas fa-check text-warning"></i> Approved (Ditolak)
                </a>
            @else
                <a class="dropdown-item" href="{{ $approve1 }}" id="approved1-data-dar"
                    data-id="{{ $model->reqdar_id }}"
                    row-approve-manager="{{ $model->approval_date1 }}">
                    <i class="fas fa-check text-warning"></i> Approved
                </a>
            @endif

            <a class="dropdown-item" href="{{ $rejectedAppr1 }}" id="rejected1-data-dar"
                data-id="{{ $model->reqdar_id }}"
                row-approve-manager="{{ $model->approval_date1 }}">
                <i class="fas fa-ban text-danger"></i> Rejected
            </a>

            <a class="dropdown-item" href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-dar">
                <i class="fas fa-eye text-secondary"></i> Show
            </a>
        </div>
    </div>
@endpermission