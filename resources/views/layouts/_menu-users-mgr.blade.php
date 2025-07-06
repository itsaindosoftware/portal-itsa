@permission('manage-dar-system')
<li class="menu-header">Main Menu</li>
@endpermission
@permission('manage-dar-system','manager-masterdocs')
<li class="{{ route('requestdar.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('requestdar.index') }}">
    <i class="fas fa-clipboard-list"></i> <span>Request Dar</span>
    </a>
  </li>
   <li class="{{ route('masterdocs.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('masterdocs.index') }}">
    <i class="fas fa-clipboard-list"></i> <span>Master Docs</span>
    </a>
  </li>
@endpermission



