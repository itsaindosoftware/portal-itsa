  <style>
    /* General Styling */
    body {
      font-family: 'Poppins', sans-serif;
      scroll-behavior: smooth;
      overflow-x: hidden;
    }

    .section-padding {
      padding: 100px 0;
    }

    /* Parallax Effect */
    .parallax-section {
      background-attachment: fixed;
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      transition: all 0.5s ease;
      position: relative;
    }

    /* Header Styling */
    .header {
      position: fixed;
      width: 100%;
      top: 0;
      left: 0;
      z-index: 1000;
      background-color: rgba(255, 255, 255, 0.95);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .header-scrolled {
      background-color: #fff;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .logo {
      display: flex;
      align-items: center;
    }

    .logo img {
      height: 50px;
      margin-right: 15px;
    }

    .logo-text {
      font-weight: 600;
      font-size: 1.1rem;
      color: #333;
    }

    .nav-links a {
      margin: 0 15px;
      font-weight: 500;
      color: #333;
      text-decoration: none;
      transition: all 0.3s ease;
      position: relative;
    }

    .nav-links a:after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      background: #0d6efd;
      bottom: -5px;
      left: 0;
      transition: width 0.3s ease;
    }

    .nav-links a:hover:after {
      width: 100%;
    }

    /* Hero Section */
    .hero {
      height: 100vh;
      background: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('assets/assets-itsaportal/img/bg.jpg');
      background-size: cover;
      background-position: center;
      display: flex;
      align-items: center;
      color: white;
      text-align: center;
      position: relative;
    }

    .hero-content {
      position: relative;
      z-index: 2;
    }

    .hero h1 {
      font-size: 3.5rem;
      font-weight: 700;
      margin-bottom: 20px;
      animation: fadeInUp 1s ease;
    }

    .hero p {
      font-size: 1.2rem;
      max-width: 800px;
      margin: 0 auto 30px;
      animation: fadeInUp 1.2s ease;
    }

    /* Features Section */
    .features {
      padding-top: 100px;
      padding-bottom: 100px;
    }

    .feature-card {
      transition: all 0.3s ease;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: none;
    }

    .feature-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }

    .feature-img {
      padding: 20px 0;
    }

    .feature-content {
      padding: 30px 20px;
    }

    .feature-content h3 {
      margin-bottom: 15px;
      font-weight: 600;
      color: #333;
    }

    /* About Portal Section */
    .about-portal {
      padding-top: 100px;
      padding-bottom: 100px;
      background-color: #f8f9fa;
      position: relative;
      overflow: hidden;
    }

    .about-portal:before {
      content: '';
      position: absolute;
      top: -50px;
      left: 0;
      width: 100%;
      height: 100px;
      background: white;
      transform: skewY(-2deg);
    }

    .about-portal .section-title {
      margin-bottom: 40px;
      position: relative;
      display: inline-block;
    }

    .about-portal .section-title:after {
      content: '';
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: 3px;
      background: #0d6efd;
    }

    .about-portal p, .about-portal ul {
      text-align: left;
      max-width: 800px;
      margin-left: auto;
      margin-right: auto;
      margin-bottom: 20px;
      font-size: 1.1rem;
      line-height: 1.8;
      color: #555;
    }

    .about-portal ul {
      list-style-position: inside;
      padding-left: 20px;
    }

    .about-portal ul li {
      margin-bottom: 15px;
      position: relative;
      padding-left: 25px;
    }

    .about-portal ul li:before {
      content: '\f00c';
      font-family: 'Font Awesome 5 Free';
      font-weight: 900;
      position: absolute;
      left: 0;
      top: 2px;
      color: #0d6efd;
    }

    /* Contact Us Section */
    .contact-us {
      padding: 100px 0;
      background-color: #ffffff;
      position: relative;
    }

    .contact-us:before {
      content: '';
      position: absolute;
      top: -50px;
      left: 0;
      width: 100%;
      height: 100px;
      background: #f8f9fa;
      transform: skewY(-4deg);
    }

    .contact-info-item {
      display: flex;
      align-items: flex-start;
      margin-bottom: 30px;
    }

    .contact-icon {
      font-size: 24px;
      color: #0d6efd;
      margin-right: 20px;
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background-color: rgba(13, 110, 253, 0.1);
    }

    .contact-details h5 {
      font-weight: 600;
      margin-bottom: 8px;
    }

    .contact-details p {
      margin-bottom: 0;
      color: #555;
    }

    .contact-form .form-control {
      height: 50px;
      border-radius: 10px;
      margin-bottom: 20px;
      padding: 10px 20px;
      border: 1px solid #dee2e6;
      font-size: 14px;
    }

    .contact-form textarea.form-control {
      height: 150px;
      resize: none;
    }

    .contact-form .btn-submit {
      padding: 12px 30px;
      border-radius: 10px;
      font-weight: 500;
      border: none;
      background-color: #0d6efd;
      color: white;
      transition: all 0.3s ease;
    }

    .contact-form .btn-submit:hover {
      background-color: #0b5ed7;
      transform: translateY(-3px);
      box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
    }

    .map-container {
      height: 450px;
      overflow: hidden;
      border-radius: 15px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    /* Footer */
    .footer {
      margin-top: 0;
      padding-top: 80px;
      padding-bottom: 40px;
      background-color: #161718;
      color: #fff;
      position: relative;
    }

    .footer:before {
      content: '';
      position:fixed;
      top: -50px;
      left: 0;
      width: 100%;
      height: 100px;
      background: #ffffff;
      transform: skewY(-2deg);
    }

    .footer-content {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 30px;
    }

    .footer-col {
      flex: 1;
      min-width: 250px;
    }

    .footer-col h4 {
      margin-bottom: 25px;
      font-weight: 600;
      position: relative;
      padding-bottom: 15px;
    }

    .footer-col h4:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 50px;
      height: 2px;
      background: #0d6efd;
    }

    .footer-col ul {
      list-style: none;
      padding: 0;
    }

    .footer-col ul li {
      margin-bottom: 15px;
    }

    .footer-col ul li a {
      color: #adb5bd;
      text-decoration: none;
      transition: all 0.3s ease;
    }

    .footer-col ul li a:hover {
      color: #fff;
      padding-left: 5px;
    }

    .copyright {
      padding-top: 30px;
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      color: #adb5bd;
    }

    /* .menu-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 1.5rem;
      color: #333;
      cursor: pointer;
      padding: 10px;
      z-index: 1001;
      position: relative;
      transition: color 0.3s ease;
    } */

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* Responsive */
    @media (max-width: 992px) {
      .menu-toggle {
        display: inline-flex !important;
      }

      .nav-links {
        position: fixed !important;
        top: 80px !important;
        right: -100% !important;
        width: 300px !important;
        height: calc(100vh - 80px) !important;
        background: #fff !important;
        flex-direction: column !important;
        justify-content: flex-start !important;
        align-items: center !important;
        padding: 40px 0 !important;
        transition: right 0.5s ease !important;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1) !important;
        z-index: 999 !important;
      }

      .nav-links.active {
        right: 0 !important;
      }

      .nav-links a {
        margin: 15px 0 !important;
        display: block !important;
        text-align: center !important;
        width: 100% !important;
        padding: 10px 20px !important;
      }
    }

    @media (max-width: 768px) {
      .contact-form {
        margin-top: 40px;
      }

      .map-container {
        margin-top: 40px;
        height: 300px;
      }
    }
        .contact-us {
            padding: 80px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 2px;
            margin: 0 auto;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease;
        }

        .contact-info-item:hover {
            transform: translateY(-3px);
        }

        .contact-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .contact-icon i {
            font-size: 1.5rem;
            color: white;
        }

        .contact-details h5 {
            color: #343a40;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .contact-details p {
            color: #6c757d;
            margin: 0;
            line-height: 1.6;
        }

        .contact-form {
            background: white;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn-submit {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,123,255,0.4);
        }

        .map-container {
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        /* Department Extensions Styles */
        .department-section {
            margin-top: 4rem;
            padding: 2rem 0;
        }

        .department-card {
            background: white;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .department-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }

        .department-card h5 {
            color: #007bff;
            font-weight: 700;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #e9ecef;
        }

        .dept-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .dept-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .dept-item:last-child {
            border-bottom: none;
        }

        .dept-name {
            color: #495057;
            font-weight: 500;
        }

        .ext-number {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.875rem;
            font-weight: 600;
            min-width: 45px;
            text-align: center;
        }

        .main-phones {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            text-align: center;
        }

        .main-phones h4 {
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .phone-numbers {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .phone-item {
            background: rgba(255,255,255,0.2);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .contact-us {
                padding: 40px 0;
            }

            .department-card {
                margin-bottom: 1rem;
            }

            .phone-numbers {
                flex-direction: column;
                align-items: center;
            }
        }
        /* About Portal Section - Fixed */
.about-portal {
  padding-top: 120px !important;
  padding-bottom: 100px !important;
  background-color: #f8f9fa;
  position: relative;
  overflow: visible; /* Changed from hidden */
  min-height: auto; /* Ensure minimum height */
}

/* Remove the skew effect that might cause cutting */
.about-portal:before {
  display: none; /* Temporarily disable the skew effect */
}

.about-portal .section-title {
  margin-bottom: 40px;
  position: relative;
  display: inline-block;
}

.about-portal .section-title:after {
  content: '';
  position: absolute;
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 3px;
  background: #0d6efd;
}

.about-portal p, .about-portal ul {
  text-align: justify !important; /* Force justify alignment */
  max-width: 100% !important; /* Remove max-width restriction */
  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;
  font-size: 1.1rem;
  line-height: 1.8;
  color: #555;
}

.about-portal ul {
  list-style-position: outside;
  padding-left: 30px;
}

.about-portal ul li {
  margin-bottom: 15px;
  position: relative;
}

/* Remove the custom bullet point that might cause issues */
.about-portal ul li:before {
  display: none;
}

/* Add proper bullet points */
.about-portal ul li {
  list-style-type: disc;
}

/* Ensure content is fully visible */
.about-content {
  background: white;
  padding: 40px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  margin-bottom: 40px;
  width: 100%;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .about-portal {
    padding-top: 100px !important;
    padding-bottom: 80px !important;
  }

  .about-content {
    padding: 30px 20px;
  }

  .about-portal p, .about-portal ul {
    font-size: 1rem;
  }
}

/* Fix for header overlap */
body {
  padding-top: 0; /* Remove any top padding that might interfere */
}

/* Ensure proper spacing from header */
.about-portal {
  margin-top: 80px; /* Account for fixed header height */
}
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

    .search-box input:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .form-select:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Custom pagination styles */
    .pagination {
      justify-content: center;
      margin: 0;
    }

    .page-link {
      border: 1px solid #dee2e6;
      background: white;
      color: #007bff;
      padding: 12px 16px;
      border-radius: 8px;
      margin: 0 5px;
      text-decoration: none;
    }

    .page-link:hover {
      background: linear-gradient(135deg, #007bff, #0056b3) !important;
      color: white !important;
      border-color: transparent !important;
    }

    .page-item.active .page-link {
      background: linear-gradient(135deg, #007bff, #0056b3);
      border: none;
      color: white;
    }

    .page-item.disabled .page-link {
      background: transparent;
      color: #6c757d;
      border: none;
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

      .search-filter-section .row > div {
        margin-bottom: 15px !important;
      }

      .search-filter-section .btn {
        margin-top: 10px;
      }
    }
    .slideshow-bg {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 1;
      background-size: cover;
      background-position: center;
      animation: slideShow 20s infinite ease-in;
      background-repeat: no-repeat
    }

    /* @keyframes slideShow {
      0% { background-image:linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}'); }
      25% { background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/slide2.jpeg') }}'); }
      50% { background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('storage/news/2.png') }}'); }
      75% { background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}'); }
      100% { background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/slide2.jpeg') }}'); }
    } */
     @keyframes slideShow {
        0% { 
        background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}'); 
        }
        33.33% { 
          background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/slide2.jpeg') }}'); 
        }
        66.66% { 
          background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/pic-99.jpeg') }}'); 
        }
        100% { 
        background-image: linear-gradient(rgba(189, 182, 182, 0.7), rgba(56, 54, 54, 0.7)), url('{{ asset('assets/assets-itsaportal/img/bg.jpg') }}'); 
        }
    }
    #service-link {
      background-color: #f0f8ff;
      padding: 10px 20px;
      border-radius: 25px;
      font-weight: bold;
      text-decoration: none;
      text-transform: uppercase;
      letter-spacing: 1px;
      font-size: 13px;
      border: 1px solid #e0e7ff;
      transition: all 0.3s ease;
    }
    #service-link:hover {
      background-color: #e0e7ff;
      color: #040404;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
  </style> 