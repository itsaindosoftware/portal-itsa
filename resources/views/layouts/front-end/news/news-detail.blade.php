@extends('layouts.front-end.layouts-custom.layouts-custom')

@section('title', $news->title . ' - Portal ITSA')

@section('content')
  <!-- Breadcrumb -->
  <section class="breadcrumb-section" style="background: #f8f9fa; padding: 40px 0; margin-top: 80px;">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mb-0" style="background: transparent; padding: 0;">
          <li class="breadcrumb-item"><a href="{{ url('/') }}" style="color: #007bff; text-decoration: none;">Home</a></li>
          <li class="breadcrumb-item"><a href="{{ route('news') }}" style="color: #007bff; text-decoration: none;">News</a></li>
          <li class="breadcrumb-item active" aria-current="page" style="color: #6c757d;">{{ Str::limit($news->title, 50) }}</li>
        </ol>
      </nav>
    </div>
  </section>

  <!-- News Detail Section -->
  <section class="news-detail-section" style="padding: 80px 0; background-color: #fff;">
    <div class="container">
      <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 mb-5">
          <article class="news-article">
            <!-- Article Header -->
            <div class="article-header mb-4">
              @if($news->category)
              @php
                $categoryColors = [
                  'General' => 'rgba(13, 110, 253, 0.9)',
                  'Announcement' => 'rgba(40, 167, 69, 0.9)',
                  'Event' => 'rgba(255, 193, 7, 0.9)',
                  'Update' => 'rgba(220, 53, 69, 0.9)',
                  'Promotion' => 'rgba(111, 66, 193, 0.9)'
                ];
                $bgColor = $categoryColors[$news->category] ?? 'rgba(108, 117, 125, 0.9)';
              @endphp
              <span class="category-badge" style="background: {{ $bgColor }}; color: white; padding: 8px 20px; border-radius: 25px; font-size: 0.875rem; font-weight: 600; display: inline-block; margin-bottom: 20px;">{{ $news->category }}</span>
              @endif

              <h1 class="article-title" style="color: #333; font-weight: 700; line-height: 1.3; margin-bottom: 20px;">{{ $news->title }}</h1>

              <div class="article-meta" style="border-bottom: 1px solid #e9ecef; padding-bottom: 20px; margin-bottom: 30px;">
                <div class="row align-items-center">
                  <div class="col-md-8">
                    <div class="meta-info">
                      <span style="color: #6c757d; font-size: 0.95rem; margin-right: 25px;">
                        <i class="fas fa-calendar me-2"></i>{{ \Carbon\Carbon::parse($news->created_at)->format('F d, Y') }}
                      </span>
                      @if($news->name_user)
                      <span style="color: #6c757d; font-size: 0.95rem; margin-right: 25px;">
                        <i class="fas fa-user me-2"></i>{{ $news->name_user }}
                      </span>
                      @endif
                      @if($news->dept_name)
                      <span style="color: #6c757d; font-size: 0.95rem;">
                        <i class="fas fa-building me-2"></i>{{ $news->dept_name }}
                      </span>
                      @endif
                    </div>
                  </div>
                  <div class="col-md-4 text-md-end">
                    <div class="share-buttons">
                      <span style="color: #6c757d; font-size: 0.9rem; margin-right: 10px;">Share:</span>
                      <a href="#" onclick="shareOnFacebook()" class="btn btn-sm me-2" style="background: #1877f2; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fab fa-facebook-f"></i>
                      </a>
                      <a href="#" onclick="shareOnTwitter()" class="btn btn-sm me-2" style="background: #1da1f2; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fab fa-twitter"></i>
                      </a>
                      <a href="#" onclick="shareOnWhatsApp()" class="btn btn-sm" style="background: #25d366; color: white; border: none; border-radius: 50%; width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center;">
                        <i class="fab fa-whatsapp"></i>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Featured Image -->
            @if($news->pic)
            <div class="article-image mb-4">
              <img src="{{ asset('storage/news/' . $news->pic) }}" alt="{{ $news->title }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1);">
            </div>
            @endif

            <!-- Article Content -->
            <div class="article-content" style="color: #333; line-height: 1.8; font-size: 1.1rem;">
              {!! nl2br(e($news->description)) !!}
            </div>

            <!-- Back to News Button -->
            <div class="article-footer" style="margin-top: 50px; padding-top: 30px; border-top: 1px solid #e9ecef;">
              <a href="{{ route('news') }}" class="btn" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: transform 0.3s ease;">
                <i class="fas fa-arrow-left me-2"></i>Back to News
              </a>
            </div>
          </article>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
          <!-- Related News -->
          @if($relatedNews->count() > 0)
          <div class="sidebar-section" style="background: white; border-radius: 15px; padding: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.08); margin-bottom: 30px;">
            <h4 class="sidebar-title" style="color: #333; font-weight: 700; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #007bff;">Related News</h4>

            @foreach($relatedNews as $related)
            <div class="related-item" style="margin-bottom: 25px; padding-bottom: 20px; border-bottom: 1px solid #f0f0f0;">
              <div class="row g-3">
                <div class="col-4">
                  <img src="{{ $related->pic ? asset('storage/news/' . $related->pic) : '/api/placeholder/150/100' }}" alt="{{ $related->title }}" style="width: 100%; height: 80px; object-fit: cover; border-radius: 8px;">
                </div>
                <div class="col-8">
                  <h6 style="margin: 0 0 8px 0; line-height: 1.3;">
                    <a href="{{ route('news.show', $related->id) }}" style="color: #333; text-decoration: none; font-weight: 600; font-size: 0.95rem;">{{ Str::limit($related->title, 60) }}</a>
                  </h6>
                  <small style="color: #6c757d; font-size: 0.8rem;">
                    <i class="fas fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($related->created_at)->format('M d, Y') }}
                  </small>
                </div>
              </div>
            </div>
            @endforeach
          </div>
          @endif

          <!-- Quick Navigation -->
          <div class="sidebar-section" style="background: linear-gradient(135deg, #007bff, #0056b3); border-radius: 15px; padding: 30px; color: white;">
            <h4 class="sidebar-title" style="color: white; font-weight: 700; margin-bottom: 25px;">Quick Navigation</h4>

            <div class="nav-links">
              <a href="{{ route('news') }}" style="display: block; color: white; text-decoration: none; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.2); font-weight: 500; transition: padding-left 0.3s ease;">
                <i class="fas fa-newspaper me-2"></i>All News
              </a>
              <a href="{{ route('news', ['category' => 'Company Update']) }}" style="display: block; color: white; text-decoration: none; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.2); font-weight: 500; transition: padding-left 0.3s ease;">
                <i class="fas fa-building me-2"></i>Company Updates
              </a>
              <a href="{{ route('news', ['category' => 'Technology']) }}" style="display: block; color: white; text-decoration: none; padding: 12px 0; border-bottom: 1px solid rgba(255,255,255,0.2); font-weight: 500; transition: padding-left 0.3s ease;">
                <i class="fas fa-laptop-code me-2"></i>Technology
              </a>
              <a href="{{ route('news', ['category' => 'Safety']) }}" style="display: block; color: white; text-decoration: none; padding: 12px 0; font-weight: 500; transition: padding-left 0.3s ease;">
                <i class="fas fa-shield-alt me-2"></i>Safety News
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    function shareOnFacebook() {
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent('{{ $news->title }}');
      window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    }

    function shareOnTwitter() {
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent('{{ $news->title }}');
      window.open(`https://twitter.com/intent/tweet?url=${url}&text=${title}`, '_blank', 'width=600,height=400');
    }

    function shareOnWhatsApp() {
      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent('{{ $news->title }}');
      window.open(`https://wa.me/?text=${title} ${url}`, '_blank');
    }
  </script>

  <style>
    .btn:hover {
      transform: translateY(-2px);
    }

    .related-item:hover h6 a {
      color: #007bff !important;
    }

    .nav-links a:hover {
      padding-left: 15px;
      background: rgba(255,255,255,0.1);
      border-radius: 8px;
    }

    .share-buttons .btn:hover {
      transform: scale(1.1);
    }

    .article-content p {
      margin-bottom: 1.5rem;
    }

    .article-content h2, .article-content h3, .article-content h4 {
      margin-top: 2rem;
      margin-bottom: 1rem;
      color: #333;
    }

    .article-content ul, .article-content ol {
      margin-bottom: 1.5rem;
      padding-left: 2rem;
    }

    .article-content li {
      margin-bottom: 0.5rem;
    }

    @media (max-width: 768px) {
      .breadcrumb-section {
        margin-top: 60px !important;
        padding: 20px 0 !important;
      }

      .news-detail-section {
        padding: 40px 0 !important;
      }

      .article-header .row {
        flex-direction: column;
      }

      .article-header .col-md-4 {
        margin-top: 15px;
        text-align: left !important;
      }

      .share-buttons {
        justify-content: flex-start;
      }

      .article-image img {
        height: 250px !important;
      }

      .sidebar-section {
        margin-top: 40px;
      }
    }
  </style>

@endsection
