@permission('manage-digital-assets')
<li class="menu-header">Main Menu</li>
@endpermission
@permission('manage-digital-assets')
<li>
    <a class="nav-link" href="{{ route('digitalassets.index') }}">
    <i class="fas fa-database"></i> <span>Digital Assets Reg</span>
    </a>
  </li>
@endpermission