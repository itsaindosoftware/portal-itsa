<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Portal ITSA - PT Indonesia Thai Summit Auto</title>
  <!-- Bootstrap 5 CSS -->
  <link href="{{ asset('assets/assets-itsaportal/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Custom CSS -->
  <!-- <link rel="stylesheet" href="assets/css/custom.css"> -->
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
      background-color: #212529;
      color: #fff;
      position: relative;
    }
    
    .footer:before {
      content: '';
      position: absolute;
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
        display: block;
      }
      
      .nav-links {
        position: fixed;
        top: 80px;
        right: -100%;
        width: 300px;
        height: calc(100vh - 80px);
        background: #fff;
        flex-direction: column;
        padding: 40px 0;
        transition: all 0.5s ease;
        box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
      }
      
      .nav-links.active {
        right: 0;
      }
      
      .nav-links a {
        margin: 15px 0;
        display: block;
        text-align: center;
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
  </style>
</head>