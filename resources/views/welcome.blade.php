<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Home - Research Academy</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('frontend/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('frontend/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@800&family=Nunito:wght@400;800&family=Quicksand:wght@500;800&display=swap" rel="stylesheet">
  
  <!-- Vendor CSS Files -->
  <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">

  <!-- Template Info -->
  <!-- =======================================================
  * Template Name: Mentor
  * Template URL: https://bootstrapmade.com/mentor-free-education-bootstrap-theme/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center sticky-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">
      <a href="index.html" class="logo d-flex align-items-center me-auto">
        <img src="{{ asset('frontend/assets/img/logo_HRP.png') }}" alt="HRP Logo" class="img-fluid">
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html" class="active">Home</a></li>
          <li><a href="about.html">About</a></li>
          <li><a href="courses.html">Mentor</a></li>
          <li class="dropdown">
            <a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <ul>
              <li><a href="#">Dropdown 1</a></li>
              <li><a href="#">Dropdown 2</a></li>
            </ul>
          </li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Login</a>
    </div>
  </header>
  <!-- End Header -->

  <main class="main">

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero section dark-background">
      <div class="container d-flex align-items-center">
        
        <!-- Hero Text -->
        <div class="hero-text" data-aos="fade-up">
          <h2>Research Academy</h2>
          <p>Sumber Ilmu, Sahabat Magangmu</p>
          <a href="courses.html" class="btn-get-started">Get Started</a>
        </div>

        <!-- Hero Image -->
        <div class="hero-image" data-aos="zoom-in">
          <img src="{{ asset('frontend/assets/img/hero_i.png') }}" alt="Hero Image">
        </div>
      </div>

      <!-- Decorative Elements -->
      <div class="hero-decor decor-1"></div>
      <div class="hero-decor decor-2"></div>
      <div class="hero-decor decor-3"></div>
    </section>
    <!-- End Hero Section -->

    <!-- ======= Materi Section ======= -->
<section id="materi" class="materi section">
  <div class="container">
    <!-- Section Title -->
    <div class="section-title" data-aos="fade-up">
      <p>Materi Magang</p>
      <h2></h2>
    </div>

    <div class="row">
      <!-- Materi Item 1 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 materi-card">
          <div class="card-body">
            <h5 class="card-title">Website Design</h5>
            <p class="card-text">Pelajari dasar-dasar desain website modern dan responsive untuk kebutuhan bisnis saat ini.</p>
            <a href="course-details.html" class="btn btn-primary">Pelajari Sekarang</a>
          </div>
        </div>
      </div>
      <!-- End Materi Item -->

      <!-- Materi Item 2 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 materi-card">
          <div class="card-body">
            <h5 class="card-title">Frontend Development</h5>
            <p class="card-text">Kuasi teknologi frontend terkini seperti React, Vue, dan Tailwind CSS.</p>
            <a href="course-details.html" class="btn btn-primary">Pelajari Sekarang</a>
          </div>
        </div>
      </div>
      <!-- End Materi Item -->

      <!-- Materi Item 3 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 materi-card">
          <div class="card-body">
            <h5 class="card-title">Backend Development</h5>
            <p class="card-text">Pelajari pembuatan API dan manajemen database dengan teknologi terbaru.</p>
            <a href="course-details.html" class="btn btn-primary">Pelajari Sekarang</a>
          </div>
        </div>
      </div>
      <!-- End Materi Item -->
    </div>
  </div>
</section>
<!-- End Materi Section -->

<!-- ======= Video Mentoring Section ======= -->
<section id="video-mentoring" class="video-mentoring section">
  <div class="container">
    <!-- Section Title -->
    <div class="section-title" data-aos="fade-up">
      <p>Video Mentoring</p>
      <h2></h2>
    </div>

    <div class="row">
      <!-- Video Item 1 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 video-card">
          <img src="{{ asset('frontend/assets/img/course-1.jpg') }}" class="card-img-top" alt="Website Design">
          <div class="card-body">
            <h5 class="card-title">Website Design</h5>
            <p class="card-text">Video tutorial lengkap tentang prinsip-prinsip desain website modern.</p>
            <a href="#" class="btn btn-primary">Tonton Video</a>
          </div>
        </div>
      </div>
      <!-- End Video Item -->

      <!-- Video Item 2 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 video-card">
          <img src="{{ asset('frontend/assets/img/course-2.jpg') }}" class="card-img-top" alt="SEO Tutorial">
          <div class="card-body">
            <h5 class="card-title">SEO Optimization</h5>
            <p class="card-text">Pelajari teknik SEO terbaru untuk meningkatkan ranking website Anda.</p>
            <a href="#" class="btn btn-primary">Tonton Video</a>
          </div>
        </div>
      </div>
      <!-- End Video Item -->

      <!-- Video Item 3 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 video-card">
          <img src="{{ asset('frontend/assets/img/course-3.jpg') }}" class="card-img-top" alt="Copywriting">
          <div class="card-body">
            <h5 class="card-title">Creative Copywriting</h5>
            <p class="card-text">Teknik menulis konten yang menarik dan persuasif untuk bisnis digital.</p>
            <a href="#" class="btn btn-primary">Tonton Video</a>
          </div>
        </div>
      </div>
      <!-- End Video Item -->
    </div>
  </div>
</section>
<!-- End Video Mentoring Section -->

<!-- ======= Quizz Section ======= -->
<section id="quizz" class="quizz section">
  <div class="container">
    <!-- Section Title -->
    <div class="section-title" data-aos="fade-up">
      <p>Quizz</p>
      <h2></h2>
    </div>

    <div class="row">
      <!-- Quizz Item 1 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="card h-100 quizz-card">
          <img src="{{ asset('frontend/assets/img/course-1.jpg') }}" class="card-img-top" alt="Web Design Quiz">
          <div class="card-body">
            <h5 class="card-title">Web Design Quiz</h5>
            <p class="card-text">Uji pemahaman Anda tentang prinsip-prinsip dasar desain web.</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-primary">10 Soal</span>
              <a href="#" class="btn btn-outline-primary">Mulai Quiz</a>
            </div>
          </div>
        </div>
      </div>
      <!-- End Quizz Item -->

      <!-- Quizz Item 2 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="card h-100 quizz-card">
          <img src="{{ asset('frontend/assets/img/course-2.jpg') }}" class="card-img-top" alt="SEO Quiz">
          <div class="card-body">
            <h5 class="card-title">SEO Quiz</h5>
            <p class="card-text">Tes pengetahuan Anda tentang Search Engine Optimization.</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-primary">15 Soal</span>
              <a href="#" class="btn btn-outline-primary">Mulai Quiz</a>
            </div>
          </div>
        </div>
      </div>
      <!-- End Quizz Item -->

      <!-- Quizz Item 3 -->
      <div class="col-md-6 col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="card h-100 quizz-card">
          <img src="{{ asset('frontend/assets/img/course-3.jpg') }}" class="card-img-top" alt="Copywriting Quiz">
          <div class="card-body">
            <h5 class="card-title">Copywriting Quiz</h5>
            <p class="card-text">Evaluasi kemampuan menulis konten persuasif Anda.</p>
            <div class="d-flex justify-content-between align-items-center">
              <span class="badge bg-primary">12 Soal</span>
              <a href="#" class="btn btn-outline-primary">Mulai Quiz</a>
            </div>
          </div>
        </div>
      </div>
      <!-- End Quizz Item -->
    </div>
  </div>
</section>
<!-- End Quizz Section -->

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer position-relative light-background">
  <div class="container footer-top">
    <div class="row gy-4">
      <!-- About Column -->
      <div class="col-lg-4 col-md-6 footer-about">
        <a href="index.html" class="logo d-flex align-items-center mb-3">
          <img src="{{ asset('frontend/assets/img/logo_HRP.png') }}" alt="Mentor Logo" style="height: 40px;">
        </a>
        <div class="footer-contact pt-3">
          <p><i class="bi bi-geo-alt-fill me-2"></i> A108 Adam Street, New York, NY 535022</p>
          <p><i class="bi bi-telephone-fill me-2"></i> <strong>Phone:</strong> +1 5589 55488 55</p>
          <p><i class="bi bi-envelope-fill me-2"></i> <strong>Email:</strong> info@example.com</p>
        </div>
        <div class="social-links d-flex mt-4">
          <a href="#" class="me-2"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="me-2"><i class="bi bi-facebook"></i></a>
          <a href="#" class="me-2"><i class="bi bi-instagram"></i></a>
          <a href="#" class="me-2"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>

      <!-- Quick Links Column -->
      <div class="col-lg-2 col-md-6 footer-links">
        <h4>Quick Links</h4>
        <ul>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
          <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
        </ul>
      </div>

      <!-- Newsletter Column -->
      <div class="col-lg-6 col-md-12 footer-newsletter">
        <h4>Our Newsletter</h4>
        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
        <form action="forms/newsletter.php" method="post" class="php-email-form mt-3">
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Your email address" required>
            <button class="btn btn-primary" type="submit">Subscribe</button>
          </div>
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your subscription request has been sent. Thank you!</div>
        </form>
      </div>
    </div>
  </div>

  <!-- Copyright -->
  <div class="container-fluid copyright text-center py-3 mt-4">
    <div class="container">
      <p class="mb-0">© <span>Copyright</span> <strong class="px-1 sitename">Research Academy</strong> <span>All Rights Reserved</span></p>
      <div class="credits mt-2">
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </div>
</footer>
  <!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>
</html>