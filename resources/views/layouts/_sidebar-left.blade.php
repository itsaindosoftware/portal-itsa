<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="{{ route('apps.index') }}">PORTAL ITSA</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('apps.index') }}">St</a>
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

        {{-- Request DAR --}}
        @role('user-employee')
             @include('layouts._menu-users')
        @endrole
        @role('manager')
             @include('layouts._menu-users-mgr')
        @endrole
        @role('sysdev')
             @include('layouts._menu-users-sysdev')
        @endrole
        @role('manager-it')
             @include('layouts._menu-users-sysdev-mgrit')
        @endrole

        {{-- Digital Assets Menu --}}
        @role('user-employee-digassets')
             @include('layouts._menu-users-digitalassets')
        @endrole
        @role('user-acct-digassets')
              @include('layouts._menu-users-digitalassets-acct')
        @endrole
        @role('user-md-digasset-itsp')
              @include('layouts._menu-users-digitalassets-md-itsp')
        @endrole

      </ul>
    </li>

  </ul>
</div>
