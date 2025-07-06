@permission(['manage-masterdocs','edit-masterdocs','show-masterdocs','destroy-masterdocs'])
    <div class="dropdown">
        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                id="dropdownMenuButton-{{ $model->id }}"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false">
            <i class="fas fa-cog"></i>
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $model->id }}">
            @permission('edit-masterdocs')
                <a class="dropdown-item" href="#" data-href="{{ $edit_url }}" data-id="{{ $model->id }}" id="edit-data-masterdocs">
                    <i class="fas fa-edit text-primary"></i> Edit
                </a>
            @endpermission

            @permission('show-masterdocs')
                <a class="dropdown-item" href="#" data-href="{{ $show_url }}" data-id="{{ $model->id }}" id="show-data-masterdocs">
                    <i class="fas fa-eye text-secondary"></i> Show
                </a>
            @endpermission

            @permission('destroy-masterdocs')
                <a class="dropdown-item" href="#" data-href="{{ $delete_url }}" data-id="{{ $model->id }}" id="destroy-data-masterdocs">
                    <i class="fas fa-trash text-danger"></i> Delete
                </a>
            @endpermission
        </div>
    </div>
@endpermission
