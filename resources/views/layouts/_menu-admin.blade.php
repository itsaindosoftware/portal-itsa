@permission('manage-dar-system')
<li class="menu-header">Main Menu</li>
@endpermission
@permission(['manage-dar-system'])
<li>
    <a class="nav-link" href="{{ route('requestdar.index') }}">
    <i class="fas fa-clipboard-list"></i> <span>Request Dar</span>
    </a>
  </li>
@endpermission
@permission('manage-user|manage-module|manage-role|manage-permission')
<li class="menu-header">Setting Authorization</li>
@endpermission

@permission('manage-user')
<li>
  <a class="nav-link" href="{{ route('user.index') }}">
    <i class="fas fa-user"></i> <span>User Management</span>
  </a>
</li>
@endpermission

@permission('manage-module')
<li>
  <a class="nav-link" href="{{ route('module.index') }}">
    <i class="fas fa-cubes"></i> <span>Module</span>
  </a>
</li>
@endpermission

@permission('manage-permission')
<li>
  <a class="nav-link" href="{{ route('permission.index') }}">
    <i class="fas fa-user-lock"></i> <span>Permission</span>
  </a>
</li>
@endpermission

@permission('manage-role')
<li>
  <a class="nav-link" href="{{ route('role.index') }}">
    <i class="fas fa-user-check"></i> <span>Role</span>
  </a>
</li>
@endpermission

@permission('manage-company|manage-department|manage-position')
<li class="menu-header">Master Data</li>
@endpermission

@permission('manage-company')
<li>
  <a class="nav-link" href="{{ route('company.index') }}">
    <i class="fas fa-building"></i> <span>Company</span>
  </a>
</li>
@endpermission

@permission('manage-department')
<li>
  <a class="nav-link" href="{{ route('department.index') }}">
    <i class="fas fa-sitemap"></i> <span>Department</span>
  </a>
</li>
@endpermission

@permission('manage-position')
<li>
  <a class="nav-link" href="{{ route('position.index') }}">
    <i class="fas fa-briefcase"></i> <span>Position</span>
  </a>
</li>
@endpermission


