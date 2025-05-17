<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">DAR SYSTEM </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      {{-- @permission('manage-user|manage-module|manage-role|manage-permission') --}}
      <li class="menu-header">Dashboard</li>
      <li class="{{ route('home') == request()->url() ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
      </li>
        @role('admin')
             @include('layouts._menu-admin')
        @endrole
        @role('user-employee')
             @include('layouts._menu-users')
        @endrole
        @role('manager')
             @include('layouts._menu-users-mgr')
        @endrole

      </ul>
    </li>

  </ul>
</div>
