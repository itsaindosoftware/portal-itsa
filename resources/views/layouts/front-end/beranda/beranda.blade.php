@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', 'Beranda - Portal ITSA')

@section('content')
  {{-- HERO SECTION --}}
  {{-- <section class="hero parallax-section" id="beranda">
    <div class="container">
      <div class="hero-content">
        <h1 class="display-3 fw-bold">Welcome to Portal ITSA</h1>
        <p class="lead">Integrated platform for Document Action Request System and Digital Asset Registration of PT Indonesia Thai Summit Auto.</p>
        <a href="{{ route('service') }}" class="btn btn-primary btn-lg mt-4">Explore Services</a>
      </div>
    </div>
  </section> --}}
  <section class="hero parallax-section" id="beranda" style="position: relative; height: 100vh; overflow: hidden;">
  <div class="slideshow-bg"></div>
  <div class="container position-relative" style="z-index: 2;">
    <div class="hero-content text-white text-center" style="padding-top: 150px;">
      <h1 class="display-3 fw-bold">Welcome to Portal ITSA</h1>
      <p class="lead">Integrated platform for Document Action Request System and Digital Asset Registration of PT Indonesia Thai Summit Auto.</p>
      <a href="{{ route('service') }}" class="btn btn-primary btn-lg mt-4">Explore Services</a>
    </div>
  </div>
</section>


  {{-- SERVICE --}}
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
                      <a href="{{ route('service') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @elseif ($loop->index == '1')
                      <a href="{{ route('service') }}" class="btn btn-primary mt-3" target="_blank">
                        <i class="fas fa-external-link-alt me-2"></i>Access
                      </a>
                   @endif
              </div>
            </div>
          </div>
        </div>
        @endforeach

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

  {{-- NEWS --}}
 <section class="hero-news" style="height: 60vh; background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(0, 86, 179, 0.8)), url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}'); background-size: cover; background-position: center; display: flex; align-items: center; color: white; text-align: center; margin-top: 80px;">
    <div class="container">
      <div class="hero-content">
        <h1 class="display-4 fw-bold mb-4">Company News & Updates</h1>
        <p class="lead">Stay updated with the latest news, announcements, and developments from PT Indonesia Thai Summit Auto</p>
      </div>
    </div>
  </section>

  <!-- News Section -->
  <section class="news-section" style="padding: 100px 0; background-color: #f8f9fa;">
    <div class="container">

      <!-- Search and Filter Section -->
      <div class="row mb-5">
        <div class="col-12">
          <div class="search-filter-section" style="background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.08);">
            <form method="GET" action="{{ route('news') }}">
              <div class="row align-items-center">
                <div class="col-md-6 mb-3 mb-md-0">
                  <div class="search-box position-relative">
                    <input type="text" name="search" class="form-control" placeholder="Search news..." value="{{ $search }}" style="padding: 12px 20px 12px 45px; border: 2px solid #e9ecef; border-radius: 25px; font-size: 0.95rem;">
                    <i class="fas fa-search position-absolute" style="left: 15px; top: 50%; transform: translateY(-50%); color: #6c757d;"></i>
                  </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                  <select name="category" class="form-select" style="padding: 12px 20px; border: 2px solid #e9ecef; border-radius: 25px; font-size: 0.95rem;">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                      <option value="{{ $cat }}" {{ $category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-md-2">
                  <button type="submit" class="btn w-100" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; padding: 12px 20px; border-radius: 25px; font-weight: 600;">
                    <i class="fas fa-filter me-1"></i> Filter
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- Featured News -->
      @if($featuredNews && !$search && !$category)
      <div class="row mb-5">
        <div class="col-12">
          <h2 class="fw-bold text-center mb-4">Latest News</h2>
          <div class="divider mx-auto mb-5" style="width: 80px; height: 4px; background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 2px;"></div>
        </div>
      </div>

      <!-- Featured Article -->
      <div class="row mb-5">
        <div class="col-12">
          <div class="featured-news" style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.1); transition: transform 0.3s ease;">
            <div class="row g-0">
              <div class="col-lg-6">
                <img src="{{ $featuredNews->pic ? asset('storage/news/' . $featuredNews->pic) : '/api/placeholder/600/400' }}" alt="{{ $featuredNews->title }}" style="width: 100%; height: 400px; object-fit: cover;">
              </div>
              <div class="col-lg-6">
                <div style="padding: 40px;">
                  <div class="news-meta mb-3">
                    <span style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">{{ $featuredNews->category ?? 'News' }}</span>
                    <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($featuredNews->created_at)->format('F d, Y') }}</span>
                  </div>
                  <h3 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">{{ $featuredNews->title }}</h3>
                  <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">{{ Str::limit(strip_tags($featuredNews->description), 150) }}</p>
                  <a href="{{ route('news.show', base64_encode($featuredNews->id)) }}" class="btn" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: transform 0.3s ease;">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif

      <!-- News Grid -->
      <div class="row mb-4">
        <div class="col-12">
          <h2 class="fw-bold mb-4">{{ $search || $category ? 'Search Results' : 'All News' }}</h2>
          @if($search)
            <p class="text-muted mb-4">Showing results for: <strong>"{{ $search }}"</strong></p>
          @endif
          @if($category)
            <p class="text-muted mb-4">Category: <strong>{{ $category }}</strong></p>
          @endif
        </div>
      </div>

      @if($news->count() > 0)
      <div class="row">
        @foreach($news as $item)
        <!-- News Item -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="{{ $item->pic ? asset('storage/news/' . $item->pic) : '/api/placeholder/400/250' }}" alt="{{ $item->title }}" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              @if($item->category)
              @php
                $categoryColors = [
                  'Company Update' => 'rgba(13, 110, 253, 0.9)',
                  'Sustainability' => 'rgba(40, 167, 69, 0.9)',
                  'Achievement' => 'rgba(255, 193, 7, 0.9)',
                  'Technology' => 'rgba(220, 53, 69, 0.9)',
                  'Training' => 'rgba(111, 66, 193, 0.9)',
                  'Partnership' => 'rgba(13, 202, 240, 0.9)',
                  'Safety' => 'rgba(32, 201, 151, 0.9)',
                ];
                $bgColor = $categoryColors[$item->category] ?? 'rgba(108, 117, 125, 0.9)';
              @endphp
              <div style="position: absolute; top: 15px; left: 15px; background: {{ $bgColor }}; color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">{{ $item->category }}</div>
              @endif
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($item->created_at)->format('F d, Y') }}</span>
                @if($item->name_user)
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>{{ $item->name_user }}</span>
                @endif
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">{{ $item->title }}</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">{{ Str::limit(strip_tags($item->description), 100) }}</p>
              <a href="{{ route('news.show', base64_encode($item->id)) }}" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Pagination -->
      @if($news->hasPages())
      <div class="row mt-5">
        <div class="col-12">
          <nav aria-label="News pagination">
            {{ $news->appends(request()->query())->links('pagination::bootstrap-4') }}
          </nav>
        </div>
      </div>
      @endif

      @else
      <!-- No Results -->
      <div class="row">
        <div class="col-12 text-center" style="padding: 60px 0;">
          <i class="fas fa-newspaper" style="font-size: 4rem; color: #e9ecef; margin-bottom: 20px;"></i>
          <h4 style="color: #6c757d; margin-bottom: 10px;">No News Found</h4>
          <p style="color: #adb5bd;">{{ $search ? 'Try adjusting your search terms or filters.' : 'There are no news articles available at the moment.' }}</p>
          @if($search || $category)
          <a href="{{ route('news') }}" class="btn mt-3" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600;">View All News</a>
          @endif
        </div>
      </div>
      @endif

    </div>




  {{-- CONTACT SECTION --}}
  <section class="contact-us" id="kontak" style="padding: 100px 0; background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center">
          <h2 class="fw-bold mb-4">Contact Information</h2>
          <div class="divider mx-auto my-4"></div>
          <p class="lead mb-5">Ext Phone</p>
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
