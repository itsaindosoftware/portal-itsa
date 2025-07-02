<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portal ITSA</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
     <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
/* App Box Styles */
.app-box {
    border-radius: 16px;
    padding: 0;
    transition: all 0.3s ease;
    height: 100%;
    overflow: hidden;
    position: relative;
    border: none;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

/* App Box Color Themes */
.app-box-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.app-box-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.app-box-warning {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

.app-box-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

.app-box-danger {
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
}

.app-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
}

.app-box a {
    display: block;
    height: 100%;
}

.app-content {
    padding: 2rem;
    text-align: center;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    position: relative;
}

/* App Icon */
.app-icon-wrapper {
    margin-bottom: 1.5rem;
}

.app-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto;
    transition: all 0.3s ease;
}

.app-icon i {
    font-size: 2.2rem;
    color: white;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.app-box:hover .app-icon {
    transform: scale(1.1) rotate(5deg);
    background: rgba(255, 255, 255, 0.3);
}

/* App Title */
.app-title {
    color: white;
    font-weight: 700;
    margin-bottom: 0.75rem;
    font-size: 1.4rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

/* App Description */
.app-description {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
}

/* App Arrow */
.app-arrow {
    position: absolute;
    bottom: 1.5rem;
    right: 1.5rem;
    color: rgba(255, 255, 255, 0.7);
    font-size: 1.3rem;
    transition: all 0.3s ease;
}

.app-box:hover .app-arrow {
    color: white;
    transform: translateX(8px);
}

/* Coming Soon Style */
.app-box.coming-soon {
    opacity: 0.8;
    cursor: not-allowed;
}

.app-box.coming-soon:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.app-box.coming-soon .app-arrow {
    color: rgba(255, 255, 255, 0.6);
}

.app-box.coming-soon:hover .app-arrow {
    color: rgba(255, 255, 255, 0.8);
    transform: none;
}

/* Decorative Elements */
.app-box::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(30px, -30px);
}

.app-box::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 60px;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.05) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-20px, 20px);
}

/* Background Colors for Icons */
.bg-primary { background-color: #007bff !important; }
.bg-success { background-color: #28a745 !important; }
.bg-warning { background-color: #ffc107 !important; }
.bg-info { background-color: #17a2b8 !important; }
.bg-danger { background-color: #dc3545 !important; }
.bg-secondary { background-color: #6c757d !important; }

/* Responsive */
@media (max-width: 768px) {
    .app-content {
        padding: 2rem 1.5rem;
    }
    
    .app-icon {
        width: 70px;
        height: 70px;
    }
    
    .app-icon i {
        font-size: 1.8rem;
    }
    
    .app-title {
        font-size: 1.2rem;
    }
    
    .app-description {
        font-size: 0.9rem;
    }
}

/* Hover Effects for Better UX */
.app-box {
    position: relative;
    overflow: hidden;
}

/* Add subtle animation */
.app-box {
    animation: fadeInUp 0.6s ease forwards;
    opacity: 0;
}

.app-box:nth-child(1) { animation-delay: 0.1s; }
.app-box:nth-child(2) { animation-delay: 0.2s; }
.app-box:nth-child(3) { animation-delay: 0.3s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'PORTAL ITSA') }} --}}
                    PORTAL ITSA
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
{{-- @if(session('error'))
    <script>

    </script>
@endif --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const darAppLink = document.getElementById('dar-app-link');
        darAppLink.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'Access to DAR Application is restricted. Please contact your administrator for permissions.',
                timer: 2500,
                showConfirmButton: false
            });
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        const digassetsAppLink = document.getElementById('digassets-app-link');
        digassetsAppLink.addEventListener('click', function(event) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Access Denied',
                text: 'Access to Digital Assets Application is restricted. Please contact your administrator for permissions.',
                timer: 2500,
                showConfirmButton: false
            });
        });
    });
</script>
</html>
