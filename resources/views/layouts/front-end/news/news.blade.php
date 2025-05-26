@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', 'News - Portal ITSA')

@section('content')
  <!-- Hero Section for News -->
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
              @[]
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
  </section>

  {{-- <style>

  </style> --}}

@endsection
