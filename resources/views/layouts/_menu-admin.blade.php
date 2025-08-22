@permission('manage-dar-system')
<li class="menu-header">Main Menu</li>
@endpermission
@permission(['manage-dar-system','manage-digital-assets'])
<li class="{{ route('digitalassets.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('digitalassets.index') }}">
    <i class="fas fa-database"></i> <span>Digital Assets Reg</span>
    </a>
  </li>
<li class="{{ route('requestdar.index') == request()->url() ? 'active' : '' }}">
    <a class="nav-link" href="{{ route('requestdar.index') }}">
    <i class="fas fa-clipboard-list"></i> <span>Request DAR</span>
    </a>
  </li>
@endpermission
@permission('manage-digital-assets','manage-asset-tf-notification')
  <li class="{{ route('transfernotif.index') == request()->url() ? 'active' : '' }}">
     <a class="nav-link" href="{{ route('transfernotif.index') }}">
    <i class="fas fa-paper-plane"></i> <span>Asset Transfer Notif</span>
    </a>
   
  </li>
  @endpermission
@permission('manage-user|manage-module|manage-role|manage-permission')
<li class="menu-header">Setting Authorization</li>
@endpermission

@permission('manage-user')
<li class="{{ route('user.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('user.index') }}">
    <i class="fas fa-user"></i> <span>User Management</span>
  </a>
</li>
@endpermission

@permission('manage-module')
<li class="{{ route('module.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('module.index') }}">
    <i class="fas fa-cubes"></i> <span>Module</span>
  </a>
</li>
@endpermission

@permission('manage-permission')
<li class="{{ route('permission.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('permission.index') }}">
    <i class="fas fa-user-lock"></i> <span>Permission</span>
  </a>
</li>
@endpermission

@permission('manage-role')
<li class="{{ route('role.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('role.index') }}">
    <i class="fas fa-user-check"></i> <span>Role</span>
  </a>
</li>
@endpermission

@permission('manage-company|manage-department|manage-position')
<li class="menu-header">Master Data</li>
@endpermission

@permission('manage-company')
<li class="{{ route('company.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('company.index') }}">
    <i class="fas fa-building"></i> <span>Company</span>
  </a>
</li>
@endpermission

@permission('manage-department')
<li class="{{ route('department.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('department.index') }}">
    <i class="fas fa-sitemap"></i> <span>Department</span>
  </a>
</li>
@endpermission

@permission('manage-position')
<li class="{{ route('position.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('position.index') }}">
    <i class="fas fa-briefcase"></i> <span>Position</span>
  </a>
</li>
@endpermission


<li class="menu-header">Management PORTAL-ITSA</li>
@permission('manage-portalitsa-news')
<li class="{{ route('newsbe.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('newsbe.index') }}">
    <i class="fas fa-newspaper"></i> <span>News</span>
  </a>
</li>
@endpermission
@permission('manage-portalitsa-service')
<li class="{{ route('servicebe.index') == request()->url() ? 'active' : '' }}">
  <a class="nav-link" href="{{ route('servicebe.index') }}">
    <i class="fas fa-user-check"></i> <span>Service</span>
  </a>
</li>
@endpermission
