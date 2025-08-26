<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>@yield('title', 'Portal ITSA - PT Indonesia Thai Summit Auto')</title>
  <!-- Bootstrap 5 CSS -->
  <link href="{{ asset('bootstrap5/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  {{-- <link rel="stylesheet" href="assets/css/custom.css">  --}}
  @include('layouts.front-end.layouts-custom.custom-css')
</head>
<body>

  <!-- Header -->
  <header class="header">
    <div class="container">
      <div class="header-content d-flex justify-content-between align-items-center py-3">
        <div class="logo">
          <img src="{{ asset('assets/assets-itsaportal/img/ts.png') }}" alt="ITSA Logo">
          <div class="logo-text">PT Indonesia Thai Summit Auto</div>
        </div>
        <div class="menu-toggle d-lg-none" id="menu-toggle">
          <i class="fas fa-bars fa-2x"></i>
        </div>
        <nav class="nav-links d-none d-lg-flex align-items-center" id="nav-links">
          <a href="{{ route('beranda') }}" class="nav-item {{ request()->routeIs('beranda') ? 'active' : '' }}">Beranda</a>
          <a href="{{ route('about') }}" class="nav-item {{ request()->routeIs('about') ? 'active' : '' }}">About us</a>
           <a href="{{ route('news') }}" class="nav-item {{ request()->routeIs('news') ? 'active' : '' }}">News</a>
          <a href="{{ route('contact') }}" class="nav-item {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
           <a href="{{ route('service') }}" class="nav-item {{ request()->routeIs('service') ? 'active' : '' }}" id="service-link">E-Services</a>
        </nav>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main>
    @yield('content')
  </main>

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="footer-content">
        <div class="footer-col">
          <h4>PT Indonesia Thai Summit Auto</h4>
          <ul>
            <li><a href="{{ route('about') }}">About us</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">Career</a></li>
            <li><a href="#">News</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Layanan</h4>
          <ul>
            <li><a href="{{ route('service') }}">Document Action Request System</a></li>
            <li><a href="{{ route('service') }}">Digital Asset Registration</a></li>
            <li><a href="#">IT Request</a></li>
            <li><a href="#">IT Maintenance Order</a></li>
            <li><a href="#">IT Borrowing</a></li>
            <li><a href="#">Helpdesk IT</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Help</h4>
          <ul>
            <li><a href="#">FAQ</a></li>
            <li><a href="#">User Guide</a></li>
            <li><a href="{{ route('contact') }}">Contact Support</a></li>
            <li><a href="#">Terms & Conditions</a></li>
          </ul>
        </div>
      </div>
      <div class="copyright text-center mt-4">
        &copy; 2025 PT Indonesia Thai Summit Auto. All Rights Reserved.
      </div>
    </div>
  </footer>

  <!-- Scripts -->
  {{-- <script src="{{ asset('assets/assets-itsaportal/js/bootstrap.bundle.min.js') }}"></script>  --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const toggle = document.getElementById('menu-toggle');
  const navLinks = document.getElementById('nav-links');
  
  if (toggle && navLinks) {
    toggle.addEventListener('click', function(e) {
      e.preventDefault();
      e.stopPropagation(); // Mencegah event bubbling
      
      navLinks.classList.toggle('active');
      
      
      const icon = toggle.querySelector('i');
      if (navLinks.classList.contains('active')) {
        icon.classList.remove('fa-bars');
        icon.classList.add('fa-times');
      } else {
        icon.classList.remove('fa-times');
        icon.classList.add('fa-bars');
      }
    });
    
    // Auto close saat klik link dan klik di luar
    // ... kode lainnya
  }
});
  </script>

  @stack('scripts')

</body>
</html>
