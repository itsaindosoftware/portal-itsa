@permission('manage-dar-system')
<li class="menu-header">Main Menu</li>
@endpermission
@permission('manage-dar-system')
<li>
    <a class="nav-link" href="{{ route('requestdar.index') }}">
    <i class="fas fa-clipboard-list"></i> <span>Request Dar</span>
    </a>
  </li>
@endpermission



