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

        <!-- DARS -->
         @foreach ($service as $item)
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
              <div class="text-center">
                   @if ($loop->index == '0')
                      <a href="{{ url('login') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @elseif ($loop->index == '1')
                      <a href="{{ url('/login-digitalassets') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach

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
          </div>
        </div> --}}
        @endsection
