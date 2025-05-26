<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>PORTALITSA</title>

  <!-- General CSS Files -->
  <link href="{{ asset('assets/assets-itsaportal/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('assets/assets-itsaportal/css/all.min.css') }}" rel="stylesheet">

  <style>
    :root {
      /* Elegant & Simple Color Scheme */
      --primary-color: #54B689;
      --text-color: #2d2d2d;
      --muted-color: #767676;
      --light-bg: #f7f9fb;
      --border-color: #e4e8ee;
      --focus-color: rgba(84, 182, 137, 0.2);
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      color: var(--text-color);
      margin: 0;
      padding: 0;
      height: 100vh;
      overflow: hidden;
    }

    /* Grid Layout */
    .login-grid {
      display: grid;
      grid-template-columns: 1fr 400px;
      height: 100vh;
    }

    /* Left side - Landscape Background */
    .landscape-section {
      background-image: url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      position: relative;
      overflow: hidden;
    }

    .landscape-content {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(74, 222, 128, 0.1) 50%, rgba(125, 216, 125, 0.1) 100%);
    }

    /* Right side - Login Form Container */
    .login-section {
      background-color: var(--light-bg);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
      box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
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
      background-color: #489e77;
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

    /* Responsive */
    @media (max-width: 768px) {
      .login-grid {
        grid-template-columns: 1fr;
        grid-template-rows: 200px 1fr;
      }
      
      .landscape-section {
        height: 200px;
      }
      
      .login-section {
        box-shadow: none;
      }
      
      .login-container {
        margin: 1rem;
      }
    }
  </style>
</head>

<body>
  <div class="login-grid">
    <!-- Left Side - Landscape -->
    <div class="landscape-section">
      <div class="landscape-content"></div>
    </div>

    <!-- Right Side - Original Login Form -->
    <div class="login-section">
      <div class="login-container">
        <div class="brand-section">
          <img src="assets/img/ts.png" alt="Document Icon" height="45">
          <h3>Portal ITSA</h3>
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
  </div>

  <!-- JS Files -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>