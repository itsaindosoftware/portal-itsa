<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>DIgital Assets</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset("bootstrap5/css/bootstrap.min.css") }}">
  <link rel="stylesheet" href="{{ asset("bootstrap5/css/all.min.css") }} ">
  <link rel="shortcut icon" href="{{ asset('assets/img/ts.png') }}">

  <style>
    :root {
      /* Elegant & Simple Color Scheme */
      --primary-color: #4053c1;
      --text-color: #2d2d2d;
      --muted-color: #767676;
      --light-bg: #f7f9fb;
      --border-color: #e4e8ee;
      --focus-color: rgba(84, 182, 137, 0.2);
    }

    body {
      background-color: var(--light-bg);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-color);
    }

    .login-container {
      background-color: white;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
      width: 100%;
      max-width: 400px;
    }

    .brand-section {
      padding: 2rem 2rem 1rem;
      text-align: center;
    }

    .brand-section h3 {
      font-weight: 600;
      font-size: 1.5rem;
      margin: 1rem 0 0.5rem;
      color: var(--text-color);
    }

    .brand-section p {
      color: var(--muted-color);
      font-size: 0.95rem;
      margin-bottom: 0;
    }

    .form-section {
      padding: 1.5rem 2rem 2rem;
    }

    .form-floating {
      margin-bottom: 1.25rem;
    }

    .form-control {
      border-radius: 4px;
      padding: 0.75rem 1rem;
      border: 1px solid var(--border-color);
      transition: all 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 3px var(--focus-color);
    }

    .btn-login {
      background-color: var(--primary-color);
      border: none;
      border-radius: 4px;
      padding: 0.75rem;
      font-weight: 500;
      color: white;
      width: 100%;
      transition: all 0.2s;
    }

    .btn-login:hover {
      background-color: #5465c5;
      transform: translateY(-1px);
    }

    .form-check-input:checked {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }

    .footer {
      text-align: center;
      color: var(--muted-color);
      padding: 1rem 0;
      font-size: 0.85rem;
    }

    @media (max-width: 576px) {
      .login-container {
        margin: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="login-container">
      <div class="brand-section">
        <img src="{{ asset('assets/assets-itsaportal/img/dar.png') }}" alt="Document Icon" height="45">
        <h3>Digital Assets Registration</h3>
        <p>Sign in to access your account</p>
      </div>

      <div class="form-section">
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

          <button type="submit" class="btn btn-login">
            Sign In
          </button>
        </form>
      </div>
      
      <div class="footer">
        <p>© 2025 SYS DEV & IT DEPT</p>
      </div>
    </div>
  </div>

  <!-- JS Files -->
  <script src="{{ asset('bootstrap5/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>