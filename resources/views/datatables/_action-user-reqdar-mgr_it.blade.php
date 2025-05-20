@if($model->approval_status1 == '1' && $model->approval_date1 != null && $model->approval_status2 == '1' && $model->approval_date2 != null)
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="dropdownMenuButton-{{ $model->reqdar_id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $model->reqdar_id }}">
            @permission(['manage-dar-system'])
                @if($model->approval_status3 == '2')
                    <a class="dropdown-item disabled" href="javascript:void(0);" title="Data ditolak tidak bisa approved!">
                        <i class="fas fa-check text-warning"></i> Approved (Ditolak)
                    </a>
                @else
                    <a class="dropdown-item" href="{{ $approve3 }}" id="approved3-data-dar"
                        data-id="{{ $model->reqdar_id }}"
                        row-approve-manager="{{ $model->approval_date1 }}"
                        row-approve-sysdev="{{ $model->approval_date2 }}"
                        row-approved-status3="{{ $model->approval_status2 }}"
                        row-approved-mgrit="{{ $model->approval_date3 }}">
                        <i class="fas fa-check text-warning"></i> Approved
                    </a>
                @endif
            @endpermission

            @permission(['manage-dar-system'])
                <a class="dropdown-item" href="{{ $rejectedAppr3 }}" id="rejected3-data-dar"
                    data-id="{{ $model->reqdar_id }}"
                    row-approve-manager="{{ $model->approval_date1 }}"
                    row-approve-sysdev="{{ $model->approval_date2 }}"
                    row-approve-mgrit="{{ $model->approval_date3 }}">
                    <i class="fas fa-ban text-danger"></i> Rejected
                </a>
            @endpermission

            @permission(['manage-dar-system'])
                <a class="dropdown-item" href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-dar">
                    <i class="fas fa-eye text-secondary"></i> Show
                </a>
            @endpermission
        </div>
    </div>
@else
    <span class="badge badge-pill badge-danger">Data belum di approved oleh manager/sysdev</span>
@endif