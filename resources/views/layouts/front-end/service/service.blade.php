@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', 'Service - Portal ITSA')

@section('content')
 {{-- FEATURES --}}
  <section class="features section-padding bg-light" id="layanan">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold">ITSA Portal Services</h2>
        <div class="divider mx-auto my-4"></div>
        <p class="lead">Integrated system access for company operational and documentation needs</p>
      </div>
      <div class="row g-4 justify-content-center">
        
        <!-- LOGIN FORM -->
        <div class="col-md-6 col-lg-5">
          <div class="login-card h-100">
            <div class="text-center mb-4">
              <h3 class="fw-bold">Login to ITSA Portal</h3>
              <p class="text-muted">Access your integrated system services</p>
            </div>

            {{-- Display validation errors --}}
            @if ($errors->any())
              <div class="alert alert-danger">
                <ul class="mb-0">
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
              </div>
            @endif

            {{-- Display success message --}}
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif

            {{-- Display error message --}}
            @if (session('error'))
              <div class="alert alert-danger">
                {{ session('error') }}
              </div>
            @endif

           <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
            @csrf

            <div class="form-floating mb-3">
              <input type="text" class="form-control @error('nik') is-invalid @enderror"
                id="nik" name="nik" value="{{ old('nik') }}"
                placeholder="NIK" required autocomplete="off" autofocus>
              <label for="nik">NIK</label>
              @error('nik')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="form-floating mb-3">
              <input type="password" class="form-control @error('password') is-invalid @enderror"
                id="password" name="password" placeholder="Password" autocomplete="off" required>
              <label for="password">Password</label>
              @error('password')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
              @enderror
            </div>

            <div class="form-check mb-3">
              <input class="form-check-input" type="checkbox" name="remember" id="remember-me">
              <label class="form-check-label" for="remember-me">
                Remember Me
              </label>
            </div>

            <button type="submit" class="btn btn-primary btn-lg w-100">
              <i class="fas fa-sign-in-alt me-2"></i> Sign In
            </button>
          </form>
          <br>

            {{-- <div class="text-center mt-4">
              <a href="{{ route('password.request') }}" class="text-decoration-none">
                Forgot your password?
              </a>
            </div> --}}

            {{-- Service Links --}}
            {{-- <div class="mt-4 pt-4 border-top">
              <p class="text-center text-muted mb-3">Quick Access to Services:</p>
              <div class="row g-2">
                <div class="col-6">
                  <a href="{{ url('login') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-file-alt me-1"></i>DARS
                  </a>
                </div>
                <div class="col-6">
                  <a href="{{ url('/login-digitalassets') }}" class="btn btn-outline-primary btn-sm w-100">
                    <i class="fas fa-digital-tachograph me-1"></i>Digital Assets
                  </a>
                </div>
              </div>
            </div> --}}
          </div>
        </div>

        <!-- DARS -->
         {{-- @foreach ($service as $item)
        <div class="col-md-6 col-lg-4">
          <div class="feature-card h-100">
            <div class="feature-img text-center my-4">
              @if ($loop->index == '0')
                 <img src="{{ asset('assets/assets-itsaportal/img/dar.png') }}" alt="Document Action Request System" style="height: 80px;">
              @elseif ($loop->index == '1')
                 <img src="{{ asset('assets/assets-itsaportal/img/da.png') }}" alt="Digital Asset Management" style="height: 80px;">
              @endif
             
            </div>
            <div class="feature-content">
              <h3 class="h5 text-center fw-bold">{{ $item->title }}</h3>
              <p class="text-center">{{ $item->description }}</p>
              <div class="text-center"> --}}
                   {{-- @if ($loop->index == '0')
                      <a href="{{ url('login') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @elseif ($loop->index == '1')
                      <a href="{{ url('/login-digitalassets') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @endif --}}
              {{-- </div>
            </div>
          </div>
        </div>
        @endforeach --}}

        <!-- DAM -->
 {{-- <div class="col-md-6 col-lg-4">
          <div class="feature-card h-100">
            <div class="feature-img text-center my-4">
              <img src="{{ asset('assets/assets-itsaportal/img/da.png') }}" alt="Digital Asset Management" style="height: 80px;">
            </div>
            <div class="feature-content">
              <h3 class="h5 text-center fw-bold">Digital Asset Registration</h3>
              <p class="text-center">Management of corporate digital assets with high security and ease of access for authorized users.</p>
              <div class="text-center">
                <a href="{{ url('/login-digitalassets') }}" class="btn btn-primary mt-3" target="_blank">
                  <i class="fas fa-external-link-alt me-2"></i>Access
                </a>
              </div>
            </div>
          </div> --}}
        </div> 

{{-- Custom CSS --}}
<style>
.login-card {
  background: white;
  padding: 2rem;
  border-radius: 10px;
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  border: 1px solid #e9ecef;
}

.input-group-text {
  background-color: #f8f9fa;
  border-right: none;
}

.form-control:focus {
  border-color: #007bff;
  box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary {
  background: linear-gradient(45deg, #007bff, #0056b3);
  border: none;
  transition: all 0.3s ease;
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
}

.btn-outline-primary:hover {
  transform: translateY(-1px);
}

@media (max-width: 768px) {
  .login-card {
    margin: 1rem;
    padding: 1.5rem;
  }
}
</style>

{{-- JavaScript for password toggle --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
  const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#password');

  if (togglePassword && password) {
    togglePassword.addEventListener('click', function (e) {
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      
      const icon = this.querySelector('i');
      icon.classList.toggle('fa-eye');
      icon.classList.toggle('fa-eye-slash');
    });
  }
});
</script>
@endsection