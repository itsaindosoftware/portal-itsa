@permission('manage-dar-system')
<li class="menu-header">Main Menu</li>
@endpermission
@permission(['manage-dar-system','manager-docs','index-document-con'])
<li class="{{ route('requestdar.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('requestdar.index') }}">
    <i class="fas fa-paper-plane"></i> <span>Request DAR</span>
    </a>
  </li>
  <li class="{{ route('masterdocs.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('masterdocs.index') }}">
    <i class="fas fa-folder-open"></i> <span>Master Docs</span>
    </a>
  </li>
   <li class="{{ route('document-control-track') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('document-control-track') }}">
    <i class="fas fa-route"></i><span>Document Control</span>
    </a>
  </li>
@endpermission