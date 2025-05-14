<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DAR SYSTEM</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <style>
    :root {
        /* 4361ee */
      --primary-color: #6b86ff;
      --secondary-color: #3f37c9;
      --accent-color: #4895ef;
      --light-color: #f8f9fa;
      --dark-color: #212529;
    }

    body {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      min-height: 100vh;
      display: flex;
      align-items: center;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-container {
      background-color: white;
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .login-container:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
      transform: translateY(-5px);
    }

    .brand-section {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      padding: 2rem;
      text-align: center;
      position: relative;
    }

    .brand-section h3 {
      color: white;
      font-weight: bold;
      margin-bottom: 0;
    }

    .brand-logo {
      background-color: white;
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .form-section {
      padding: 2rem;
    }

    .form-floating {
      margin-bottom: 1.5rem;
    }

    .form-control {
      border-radius: 8px;
      padding: 0.75rem 1rem;
      border: 1px solid #dee2e6;
      transition: all 0.3s;
    }

    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }

    .btn-login {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border: none;
      border-radius: 8px;
      padding: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      transition: all 0.3s;
    }

    .btn-login:hover {
      background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
      transform: translateY(-2px);
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .custom-control-input:checked ~ .custom-control-label::before {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .footer {
      text-align: center;
      color: rgba(255, 255, 255, 0.7);
      padding: 1rem 0;
      font-size: 0.9rem;
    }

    .input-group-text {
      background: transparent;
      border-left: none;
      cursor: pointer;
    }

    .password-toggle {
      color: #6c757d;
      transition: color 0.3s;
    }

    .password-toggle:hover {
      color: var(--primary-color);
    }

    .form-floating>label {
      padding: 0.75rem 1rem;
    }

    @media (max-width: 576px) {
      .login-container {
        margin: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="login-container">
          <div class="brand-section">
            <div class="brand-logo">
              <img src="assets/img/doc.png" alt="Document Icon" height="45">
            </div>
            <h3>Document Action Request</h3>
          </div>

          <div class="form-section">
            <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate>
              @csrf

              <div class="form-floating mb-4">
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

              <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" name="remember" id="remember-me">
                  <label class="form-check-label" for="remember-me">
                    Remember Me
                  </label>
                </div>
                <!-- Uncomment if you want to add Forgot Password link
                <a href="#" class="text-decoration-none small text-primary">Forgot Password?</a>
                -->
              </div>

              <button type="submit" class="btn btn-login btn-primary w-100">
                Sign In <i class="fas fa-sign-in-alt ms-2"></i>
              </button>
            </form>
          </div>
        </div>

        <div class="footer">
          <p>© 2025 SYS DEV & IT DEPT</p>
        </div>
      </div>
    </div>
  </div>

  <!-- JS Files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
  <script>
    // For password visibility toggle (uncomment and modify if needed)
    /*
    document.addEventListener('DOMContentLoaded', function() {
      const togglePassword = document.querySelector('#togglePassword');
      const password = document.querySelector('#password');

      togglePassword.addEventListener('click', function() {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    });
    */
  </script>
</body>
</html>
{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DAR SYSTEM</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/modules/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/modules/fontawesome/css/all.min.css">
  <!-- CSS Libraries -->
  <link rel="stylesheet" href="assets/modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <!-- /END GA --></head>

  <body style="background-color: #4f56b1
  /*overflow-x: hidden;
  overflow-y: hidden*/">
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand" style="color: rgb(255, 255, 255); font-weight: bold;">
              Document Action Request
            </div>

            <div class="card card-primary">

              <h4 class="text-center" style="margin-top: 8px">
                <img src="{{ asset('assets/img/doc.png') }}" alt="" height="85px" width="85px">
              </h4>

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                  @csrf
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{ old('email') }}" tabindex="1" required autocomplete="off" autofocus>
                    <div class="invalid-feedback">
                     @error('email')
                     <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <div class="d-block">
                    <label for="password" class="control-label">Password</label>
                      {{-- <div class="float-right">
                        <a href="auth-forgot-password.html" class="text-small">
                          Forgot Password?
                        </a>
                      </div> --}}
                    {{-- </div>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" tabindex="2" required autocomplete="current-password">
                    <div class="invalid-feedback">
                     @error('password')
                     <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                  </div>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Login
                  </button>
                </div>
              </form>
              <hr>

            </div>
          </div> --}}
            {{-- <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="auth-register.html">Create One</a>
            </div> --}}
            {{-- <div class="simple-footer" style="color: rgb(253, 253, 253)">
              Created By &copy; SYS DEV & IT DEPT
            </div>
          </div>
        </div>
      </div>
    </section>
  </div> --}}

  <!-- General JS Scripts -->
  {{-- <script src="assets/modules/jquery.min.js"></script>
  <script src="assets/modules/popper.js"></script>
  <script src="assets/modules/tooltip.js"></script>
  <script src="assets/modules/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
  <script src="assets/modules/moment.min.js"></script>
  <script src="assets/js/stisla.js"></script> --}}

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
  {{-- <script src="assets/js/scripts.js"></script>
  <script src="assets/js/custom.js"></script> --}}
{{-- </body>
</html> --}}
