<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
     
      <a href="{{ route('apps.index') }}" class="brand-link">
         <img src="{{ asset('assets/img/ts.png') }}" alt="ITSA Logo" class="brand-image">
         <span class="brand-text">PORTAL ITSA</span>
      </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('apps.index') }}">ITSA</a>
    </div>

    <!-- User Panel -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('assets/img/avatar/avatar-1.png')}}" 
             class="img-circle elevation-2" 
             alt="User Image"
             style="width: 34px; height: 34px;">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{ Auth::user()->name ?? 'Alexander Pierce' }}</a>
        <small class="text-success">
          <i class="fas fa-circle" style="font-size: 8px;"></i> Online
        </small>
      </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      
      <li class="{{ route('home') == request()->url() ? 'active' : '' }}">
        <a href="{{ route('home') }}" class="nav-link">
          <i class="fas fa-home"></i>
          <span>Dashboard</span>
        </a>
      </li>

      {{-- Role-based Menu Includes --}}
      @role('admin')
        @include('layouts._menu-admin')
      @endrole

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
      
      @role('user-mgr-dept-head')
        @include('layouts._menu-user-mgr-dept-head')
      @endrole

      @role('manager-directur')
        @include('layouts._menu-user-mgrdir')
      @endrole
      @role('user-receive-sendnotif-dept')
        @include('layouts._menu-user-receive-sendnotif-dept')
      @endrole
      @role('user-mgr-receive-send-notif-dept')
        @include('layouts._menu-user-mgr-receive-sendnotif-dept')
      @endrole
        @role('user-gm-accfinn-sendnotif')
        @include('layouts._menu-user-gm-accfinn-sendnotif')
      @endrole
    </ul>
  </aside>
</div>

