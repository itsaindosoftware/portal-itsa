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
      
      <!-- Featured News -->
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
                <img src="/api/placeholder/600/400" alt="Featured News" style="width: 100%; height: 400px; object-fit: cover;">
              </div>
              <div class="col-lg-6">
                <div style="padding: 40px;">
                  <div class="news-meta mb-3">
                    <span style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; padding: 5px 15px; border-radius: 20px; font-size: 0.875rem; font-weight: 600;">Company Update</span>
                    <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-calendar me-1"></i>January 15, 2025</span>
                  </div>
                  <h3 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">ITSA Portal 2.0 Launch: Enhanced Digital Experience for All Employees</h3>
                  <p style="color: #666; line-height: 1.6; margin-bottom: 20px;">We are excited to announce the launch of ITSA Portal 2.0, featuring improved user interface, faster performance, and new integrated services for better employee experience...</p>
                  <a href="#" class="btn" style="background: linear-gradient(135deg, #007bff, #0056b3); color: white; border: none; padding: 12px 25px; border-radius: 25px; text-decoration: none; font-weight: 600; transition: transform 0.3s ease;">Read More <i class="fas fa-arrow-right ms-2"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- News Grid -->
      <div class="row">
        <!-- News Item 1 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(40, 167, 69, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Sustainability</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>January 10, 2025</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>Admin</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">Green Initiative: ITSA Implements Solar Panel System</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">PT Indonesia Thai Summit Auto takes a significant step towards sustainability by installing solar panel systems across the manufacturing facility...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- News Item 2 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(255, 193, 7, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Achievement</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>January 5, 2025</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>Admin</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">ITSA Receives ISO 14001 Environmental Certification</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">We are proud to announce that PT Indonesia Thai Summit Auto has successfully obtained ISO 14001 certification for environmental management...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- News Item 3 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(220, 53, 69, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Technology</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>December 28, 2024</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>Admin</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">New Automation System Improves Production Efficiency</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">ITSA introduces cutting-edge automation technology in the production line, resulting in 25% improvement in manufacturing efficiency...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- News Item 4 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(111, 66, 193, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Training</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>December 20, 2024</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>HR Team</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">Employee Development Program: Digital Skills Training</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">ITSA launches comprehensive digital skills training program to enhance employee capabilities in the digital era...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- News Item 5 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(13, 202, 240, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Partnership</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>December 15, 2024</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>Management</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">Strategic Partnership with Local Universities</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">ITSA establishes strategic partnerships with leading universities to support research and development initiatives...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>

        <!-- News Item 6 -->
        <div class="col-lg-4 col-md-6 mb-4">
          <div class="news-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.08); transition: all 0.3s ease; height: 100%;">
            <div class="news-image" style="position: relative; overflow: hidden;">
              <img src="/api/placeholder/400/250" alt="News" style="width: 100%; height: 200px; object-fit: cover; transition: transform 0.3s ease;">
              <div style="position: absolute; top: 15px; left: 15px; background: rgba(32, 201, 151, 0.9); color: white; padding: 5px 12px; border-radius: 15px; font-size: 0.8rem; font-weight: 600;">Safety</div>
            </div>
            <div style="padding: 25px;">
              <div class="news-meta mb-2">
                <span style="color: #6c757d; font-size: 0.875rem;"><i class="fas fa-calendar me-1"></i>December 10, 2024</span>
                <span style="color: #6c757d; font-size: 0.875rem; margin-left: 15px;"><i class="fas fa-user me-1"></i>Safety Team</span>
              </div>
              <h5 class="fw-bold mb-3" style="color: #333; line-height: 1.3;">Zero Accident Achievement: 365 Days Milestone</h5>
              <p style="color: #666; line-height: 1.6; font-size: 0.95rem;">ITSA celebrates a significant safety milestone with 365 consecutive days without workplace accidents, demonstrating our commitment...</p>
              <a href="#" style="color: #007bff; text-decoration: none; font-weight: 600; font-size: 0.9rem;">Read More <i class="fas fa-chevron-right ms-1"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- Pagination -->
      <div class="row mt-5">
        <div class="col-12">
          <nav aria-label="News pagination">
            <ul class="pagination justify-content-center" style="margin: 0;">
              <li class="page-item disabled">
                <a class="page-link" href="#" style="border: none; background: transparent; color: #6c757d; padding: 12px 16px;">
                  <i class="fas fa-chevron-left"></i>
                </a>
              </li>
              <li class="page-item active">
                <a class="page-link" href="#" style="background: linear-gradient(135deg, #007bff, #0056b3); border: none; color: white; padding: 12px 16px; border-radius: 8px; margin: 0 5px;">1</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#" style="border: 1px solid #dee2e6; background: white; color: #007bff; padding: 12px 16px; border-radius: 8px; margin: 0 5px;">2</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#" style="border: 1px solid #dee2e6; background: white; color: #007bff; padding: 12px 16px; border-radius: 8px; margin: 0 5px;">3</a>
              </li>
              <li class="page-item">
                <a class="page-link" href="#" style="border: none; background: transparent; color: #007bff; padding: 12px 16px;">
                  <i class="fas fa-chevron-right"></i>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

    </div>
  </section>


  <style>
    .news-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }
    
    .news-card:hover .news-image img {
      transform: scale(1.05);
    }
    
    .featured-news:hover {
      transform: translateY(-5px);
    }
    
    .btn:hover {
      transform: translateY(-2px);
    }
    
    .page-link:hover {
      background: linear-gradient(135deg, #007bff, #0056b3) !important;
      color: white !important;
      border-color: transparent !important;
    }
    
    @media (max-width: 768px) {
      .hero-news {
        height: 50vh !important;
        margin-top: 60px !important;
      }
      
      .featured-news .row > div:first-child {
        order: 2;
      }
      
      .featured-news .row > div:last-child {
        order: 1;
      }
      
      .newsletter-form .input-group {
        flex-direction: column !important;
        gap: 10px;
      }
      
      .newsletter-form .btn {
        border-radius: 25px !important;
      }
    }
  </style>

@endsection