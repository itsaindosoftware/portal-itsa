@permission(['manage-digital-assets','show-digital-assets'])
<li class="menu-header">Main Menu</li>
@endpermission
@permission(['manage-digital-assets','show-digital-assets'])
<li class="{{ route('digitalassets.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('digitalassets.index') }}">
    <i class="fas fa-database"></i> <span>Digital Assets Reg</span>
    </a>
  </li>
@endpermission
@permission('manage-digital-assets','manage-asset-tf-notification')
  <li class="{{ route('transfernotif.index') == request()->url() ? 'active' : '' }}">
     <a class="nav-link" href="{{ route('transfernotif.index') }}">
    <i class="fas fa-paper-plane"></i> <span>List Transfer Notif</span>
    </a>
   
  </li>
  @endpermission