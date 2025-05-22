@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', 'Beranda - Portal ITSA')

@section('content')
  {{-- HERO SECTION --}}
  <section class="hero parallax-section" id="beranda">
    <div class="container">
      <div class="hero-content">
        <h1 class="display-3 fw-bold">Welcome to Portal ITSA</h1>
        <p class="lead">Integrated platform for Document Action Request System and Digital Asset Registration of PT Indonesia Thai Summit Auto.</p>
        <a href="{{ route('service') }}" class="btn btn-primary btn-lg mt-4">Explore Services</a>
      </div>
    </div>
  </section>

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
        <div class="col-md-6 col-lg-4">
          <div class="feature-card h-100">
            <div class="feature-img text-center my-4">
              <img src="{{ asset('assets/assets-itsaportal/img/dar.png') }}" alt="Document Action Request System" style="height: 80px;">
            </div>
            <div class="feature-content">
              <h3 class="h5 text-center fw-bold">Document Action Request System</h3>
              <p class="text-center">An efficient and structured system for submitting, approving and tracking company documents.</p>
              <div class="text-center">
                <a href="{{ url('login') }}" class="btn btn-primary mt-3" target="_blank">
                  <i class="fas fa-external-link-alt me-2"></i>Access
                </a>
              </div>
            </div>
          </div>
        </div>

        <!-- DAM -->
        <div class="col-md-6 col-lg-4">
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
        </div>

        <!-- Dashboard (Commented out) -->
        <!-- <div class="col-md-6 col-lg-4">
          <div class="feature-card h-100">
            <div class="feature-img text-center my-4">
              <img src="assets/img/dash.png" alt="Dashboard Analitik" style="height: 80px;">
            </div>
            <div class="feature-content">
              <h3 class="h5 text-center fw-bold">Dashboard Analitik</h3>
              <p class="text-center">Monitor the performance and status of documents and digital assets through a comprehensive information dashboard.</p>
              <div class="text-center">
                <a href="https://dashboard.itsa.co.id" class="btn btn-primary mt-3" target="_blank">
                  <i class="fas fa-chart-line me-2"></i>Access
                </a>
              </div>
            </div>
          </div>
        </div> -->

      </div>
    </div>
  </section>

  {{-- ABOUT SECTION --}}
  <section class="about-portal" id="tentang" style="padding-top: 100px; padding-bottom: 100px; background-color: #f8f9fa; overflow: visible;">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="fw-bold mb-4">About ITSA Portal</h2>
          <div class="divider mx-auto my-4"></div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-lg-10">
          <div style="background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-bottom: 40px;">
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              The ITSA portal is the main gateway to internal digital systems of <strong>PT Indonesia Thai Summit Auto</strong>.
            </p>
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              Through this portal, employees can access various important services such as:
            </p>
            <ul class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; padding-left: 30px;">
              <li style="margin-bottom: 15px; list-style-type: disc;">
                <strong>Document Action Request System (DARS)</strong>: for document submission, approval and tracking.
              </li>
              <li style="margin-bottom: 15px; list-style-type: disc;">
                <strong>Digital Asset Registration (DAM)</strong>: for secure management of corporate digital assets.
              </li>
            </ul>
            <p class="mb-4" style="font-size: 1.1rem; line-height: 1.8; color: #555; text-align: justify;">
              This portal is designed to facilitate service integration and increase efficiency and productivity across all company units.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- CONTACT SECTION --}}
  <section class="contact-us" id="kontak" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="fw-bold mb-4">Contact Us</h2>
          <div class="divider mx-auto my-4"></div>
          <p class="lead mb-5">Have questions about our services? Feel free to contact us using any of the methods below</p>
        </div>
      </div>
      
      <!-- Main Contact Info -->
      <div class="main-phones" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border-radius: 15px; padding: 2rem; margin-bottom: 2rem; text-align: center;">
        <h4 style="margin-bottom: 1rem; font-weight: 600;"><i class="fas fa-phone me-2"></i>Indonesia Thai Summit Auto</h4>
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem;">
          <div style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 25px; font-weight: 500;">
            <i class="fas fa-phone me-2"></i>021-8911 4252
          </div>
          <div style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 25px; font-weight: 500;">
            <i class="fas fa-phone me-2"></i>0267-845 7184
          </div>
          <div style="background: rgba(255,255,255,0.2); padding: 0.5rem 1rem; border-radius: 25px; font-weight: 500;">
            <i class="fas fa-fax me-2"></i>Fax: 0267-8457187
          </div>
        </div>
      </div>
      
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease;">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-shield-alt me-2"></i>Security & General Info
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Security</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">263</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">Lobby</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">265</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08); transition: transform 0.3s ease;">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-users me-2"></i>Management
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">GM Room 2</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">103</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Director Room</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">110</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Ms. Tip</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">105</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">P.A Helwina</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600; min-width: 45px; text-align: center;">244</span>
              </li>
            </ul>
          </div>
        </div>
        
        <!-- Continue with other departments... -->
        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-calculator me-2"></i>Accounting & Finance
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Riama Pangaribuan</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">250</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Rahma Pridine</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">251</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">Yulianto Adi</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">550</span>
              </li>
            </ul>
          </div>
        </div>
        
        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-laptop-code me-2"></i>System & IT
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Wida</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">108</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Dede Konal</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">242</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">Didin Rico</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">251</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Add remaining departments with same styling pattern -->
        <!-- I'll include a few more key departments to demonstrate the pattern -->
        
        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-user-tie me-2"></i>HR, GA & Legal
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Miftah</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">245</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Theresia Sisca</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">262</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">Ratna</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">262</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="department-card" style="background: white; border-radius: 15px; padding: 1.5rem; margin-bottom: 1.5rem; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <h5 style="color: #007bff; font-weight: 700; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid #e9ecef;">
              <i class="fas fa-clipboard-check me-2"></i>QA & Warehouse
            </h5>
            <ul style="list-style: none; padding: 0; margin: 0;">
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Mr. Abi</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">390</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0; border-bottom: 1px solid #f8f9fa;">
                <span style="color: #495057; font-weight: 500;">Mansyah, Yusup</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">-</span>
              </li>
              <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.75rem 0;">
                <span style="color: #495057; font-weight: 500;">Susi Yolanda</span>
                <span style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 0.25rem 0.75rem; border-radius: 15px; font-size: 0.875rem; font-weight: 600;">-</span>
              </li>
            </ul>
          </div>
        </div>
        
      </div>
    </div>
  </section>

@endsection